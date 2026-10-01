<?php

// Usage: php bin/nova-stub/generate.php <project root> <output dir> <overrides.php> <seed class>...

declare(strict_types=1);

[$self, $root, $out, $overridesFile] = array_slice($argv, 0, 4);
$seeds = array_slice($argv, 4);

require $root . '/vendor/autoload.php';

/** @var array<string, string> $overrides "Class::method" => body, "Class::@extra" => extra members */
$overrides = require $overridesFile;

const NOVA = 'Laravel\\Nova\\';

function isNova(string $name): bool
{
    return str_starts_with(ltrim($name, '\\'), NOVA);
}

function exists(string $name): bool
{
    return class_exists($name) || interface_exists($name) || trait_exists($name) || enum_exists($name);
}

/** @return array<string, string> alias => FQN */
function fileImports(string|false $file): array
{
    if ($file === false || $file === '') {
        return [];
    }
    $tokens = token_get_all((string) file_get_contents($file));
    $imports = [];
    $depth = 0;
    $count = count($tokens);
    for ($i = 0; $i < $count; $i++) {
        $t = $tokens[$i];
        if ($t === '{') {
            $depth++;
        } elseif ($t === '}') {
            $depth--;
        }
        if (is_array($t) && in_array($t[0], [T_CLASS, T_TRAIT, T_INTERFACE, T_ENUM, T_FUNCTION], true)) {
            break;
        }
        if (! is_array($t) || $t[0] !== T_USE || $depth !== 0) {
            continue;
        }
        $kind = '';
        $parts = '';
        for ($j = $i + 1; $j < $count && $tokens[$j] !== ';'; $j++) {
            $tok = $tokens[$j];
            if (is_array($tok)) {
                if ($tok[0] === T_FUNCTION) {
                    $kind = 'function ';
                    continue;
                }
                if ($tok[0] === T_CONST) {
                    $kind = 'const ';
                    continue;
                }
                $parts .= $tok[1];
            } else {
                $parts .= $tok;
            }
        }
        foreach (explode(',', $parts) as $piece) {
            $piece = trim($piece);
            if ($piece === '' || str_contains($piece, '{')) {
                continue;
            }
            if (preg_match('/^(\S+)\s+as\s+(\S+)$/i', $piece, $m)) {
                $imports[$kind . $m[2]] = $kind . ltrim($m[1], '\\');
            } else {
                $name = ltrim($piece, '\\');
                $imports[$kind . substr($name, (int) strrpos('\\' . $name, '\\'))] = $kind . $name;
            }
        }
        $i = $j;
    }

    return $imports;
}

function docTags(string|false $doc, string $indent): string
{
    if ($doc === false) {
        return '';
    }
    $lines = preg_split('/\R/', $doc) ?: [];
    $kept = [];
    $inTag = false;
    foreach ($lines as $line) {
        $text = preg_replace('#^\s*/?\*+/?\s?#', '', $line) ?? '';
        $text = rtrim($text);
        if (str_ends_with(trim($line), '*/') && trim($text) === '') {
            continue;
        }
        if (str_starts_with(ltrim($text), '@')) {
            $inTag = true;
            $kept[] = $text;
        } elseif ($inTag && trim($text) !== '' && preg_match('/^\s+\S/', $text)) {
            $kept[] = $text;
        } else {
            $inTag = false;
        }
    }
    $kept = array_values(array_filter($kept, static fn (string $l): bool => ! preg_match('/^@(see|link|since|author|copyright|license|deprecated)\b/', ltrim($l))));
    if ($kept === []) {
        return '';
    }

    return $indent . "/**\n" . implode('', array_map(static fn (string $l): string => $indent . ' * ' . $l . "\n", $kept)) . $indent . " */\n";
}

/** @return list<string> class names referenced in tag lines */
function docNames(string|false $doc, string $namespace, array $imports): array
{
    if ($doc === false) {
        return [];
    }
    $names = [];
    foreach (preg_split('/\R/', $doc) ?: [] as $line) {
        if (! preg_match('/@\S+\s+(.*)$/', $line, $m)) {
            continue;
        }
        preg_match_all('/\\\\?[A-Za-z_][A-Za-z0-9_]*(?:\\\\[A-Za-z_][A-Za-z0-9_]*)*/', $m[1], $all);
        foreach ($all[0] as $candidate) {
            if (! ctype_upper(ltrim($candidate, '\\')[0] ?? 'x')) {
                continue;
            }
            $names[] = resolveName($candidate, $namespace, $imports);
        }
    }

    return $names;
}

function resolveName(string $name, string $namespace, array $imports): string
{
    if (str_starts_with($name, '\\')) {
        return ltrim($name, '\\');
    }
    $first = explode('\\', $name)[0];
    if (isset($imports[$first])) {
        return $imports[$first] . substr($name, strlen($first));
    }

    return $namespace . '\\' . $name;
}

function typeString(?ReflectionType $type): string
{
    if ($type === null) {
        return '';
    }
    if ($type instanceof ReflectionNamedType) {
        $name = $type->getName();
        $base = $type->isBuiltin() || in_array($name, ['self', 'static', 'parent'], true) ? $name : '\\' . $name;
        $nullable = $type->allowsNull() && ! in_array($name, ['mixed', 'null'], true);

        return ($nullable ? '?' : '') . $base;
    }
    if ($type instanceof ReflectionUnionType) {
        return implode('|', array_map(static fn (ReflectionType $t): string => $t instanceof ReflectionIntersectionType ? '(' . typeString($t) . ')' : typeString($t), $type->getTypes()));
    }
    if ($type instanceof ReflectionIntersectionType) {
        return implode('&', array_map('typeString', $type->getTypes()));
    }

    return (string) $type;
}

/** @return list<string> */
function typeNames(?ReflectionType $type): array
{
    if ($type === null) {
        return [];
    }
    if ($type instanceof ReflectionNamedType) {
        return $type->isBuiltin() ? [] : [$type->getName()];
    }

    return array_merge(...array_map('typeNames', $type->getTypes()));
}

function exportValue(mixed $value): string
{
    if (is_array($value)) {
        if ($value === []) {
            return '[]';
        }
        $list = array_is_list($value);
        $items = [];
        foreach ($value as $k => $v) {
            $items[] = ($list ? '' : var_export($k, true) . ' => ') . exportValue($v);
        }

        return '[' . implode(', ', $items) . ']';
    }
    if ($value instanceof UnitEnum) {
        return '\\' . $value::class . '::' . $value->name;
    }
    if (is_object($value) && in_array((new ReflectionClass($value))->getConstructor()?->getNumberOfRequiredParameters(), [null, 0], true)) {
        return 'new \\' . $value::class . '()';
    }
    if (is_object($value)) {
        throw new RuntimeException('Cannot export an object default: ' . $value::class);
    }

    return $value === null ? 'null' : var_export($value, true);
}

function paramString(ReflectionParameter $p): string
{
    $s = '';
    if ($p->isPromoted()) {
        $prop = $p->getDeclaringClass()?->getProperty($p->getName());
        $s .= ($prop?->isPublic() ? 'public ' : ($prop?->isProtected() ? 'protected ' : 'private ')) . ($prop?->isReadOnly() ? 'readonly ' : '');
    }
    $type = typeString($p->getType());
    $s .= ($type !== '' ? $type . ' ' : '') . ($p->isPassedByReference() ? '&' : '') . ($p->isVariadic() ? '...' : '') . '$' . $p->getName();
    if ($p->isDefaultValueAvailable()) {
        if ($p->isDefaultValueConstant()) {
            $const = (string) $p->getDefaultValueConstantName();
            $s .= ' = ' . (str_contains($const, '::') ? (str_starts_with($const, 'self::') || str_starts_with($const, 'static::') ? $const : '\\' . ltrim($const, '\\')) : '\\' . $const);
        } else {
            $s .= ' = ' . exportValue($p->getDefaultValue());
        }
    }

    return $s;
}

function usesFuncGetArgs(ReflectionMethod $m): bool
{
    $file = $m->getFileName();
    if ($file === false || $m->getStartLine() === false) {
        return false;
    }
    $lines = array_slice(file($file) ?: [], $m->getStartLine() - 1, (int) $m->getEndLine() - $m->getStartLine() + 1);

    return str_contains(implode('', $lines), 'func_get_args');
}

function bodyFor(ReflectionMethod $m, ?string $override): string
{
    $body = bodyCore($m, $override);

    return usesFuncGetArgs($m) && $override === null && str_starts_with($body, " {\n") ? " {\n        \\func_get_args();\n" . substr($body, 3) : $body;
}

function bodyCore(ReflectionMethod $m, ?string $override): string
{
    if ($override !== null) {
        return " {\n" . rtrim(preg_replace('/^/m', '        ', trim($override, "\n")) ?? '') . "\n    }\n";
    }
    if ($m->isAbstract() || $m->getDeclaringClass()->isInterface()) {
        return ";\n";
    }
    $ret = $m->getReturnType();
    $retName = $ret instanceof ReflectionNamedType ? $ret->getName() : '';
    $doc = (string) $m->getDocComment();
    $returnsThis = preg_match('/@return\s+(\$this|static)\b/', $doc) === 1 || $retName === 'static' || $retName === 'self';
    if ($m->getName() === '__construct' || $retName === 'void' || ($ret === null && preg_match('/@return\s+void\b/', $doc) === 1)) {
        return " {\n    }\n";
    }
    if ($m->isStatic() && $returnsThis) {
        $variadic = array_values(array_filter($m->getParameters(), static fn (ReflectionParameter $p): bool => $p->isVariadic()));

        return " {\n        return new static(" . ($variadic !== [] ? '...$' . $variadic[0]->getName() : '') . ");\n    }\n";
    }
    if (! $m->isStatic() && $returnsThis) {
        return " {\n        return \$this;\n    }\n";
    }

    return " {\n        throw new \\LogicException('The Nova test double does not implement ' . __METHOD__ . '.');\n    }\n";
}

$queue = $seeds;
$done = [];
$skipped = [];
while ($queue !== []) {
    $name = ltrim(array_shift($queue), '\\');
    if (isset($done[$name]) || ! isNova($name)) {
        continue;
    }
    if (! exists($name)) {
        $skipped[$name] = true;
        continue;
    }
    $r = new ReflectionClass($name);
    if ($r->getName() !== $name || $r->getFileName() === false) {
        fwrite(STDERR, "alias or internal: {$name} -> {$r->getName()}\n");
        $queue[] = $r->getName();
        continue;
    }
    $done[$name] = true;
    $refs = [];
    if ($r->getParentClass() !== false) {
        $refs[] = $r->getParentClass()->getName();
    }
    $refs = array_merge($refs, $r->getInterfaceNames());
    $imports = fileImports((string) $r->getFileName());
    $ns = $r->getNamespaceName();
    $refs = array_merge($refs, docNames($r->getDocComment(), $ns, $imports));
    foreach ($r->getMethods() as $m) {
        if ($m->getDeclaringClass()->getName() !== $name) {
            continue;
        }
        $mImports = $imports + fileImports((string) $m->getFileName());
        $refs = array_merge($refs, typeNames($m->getReturnType()), docNames($m->getDocComment(), $ns, $mImports));
        foreach ($m->getParameters() as $p) {
            $refs = array_merge($refs, typeNames($p->getType()));
        }
    }
    foreach ($r->getProperties() as $p) {
        if ($p->getDeclaringClass()->getName() === $name) {
            $refs = array_merge($refs, typeNames($p->getType()), docNames($p->getDocComment(), $ns, $imports));
        }
    }
    foreach ($refs as $ref) {
        if (isNova($ref) && ! isset($done[ltrim($ref, '\\')])) {
            $queue[] = $ref;
        }
    }
}

ksort($done);
foreach (array_keys($done) as $name) {
    $r = new ReflectionClass($name);
    $ns = $r->getNamespaceName();
    $imports = fileImports((string) $r->getFileName());
    $methods = array_values(array_filter($r->getMethods(), static fn (ReflectionMethod $m): bool => $m->getDeclaringClass()->getName() === $name));
    foreach ($methods as $m) {
        foreach (fileImports((string) $m->getFileName()) as $alias => $fqn) {
            $imports[$alias] ??= $fqn;
        }
    }
    $src = "<?php\n\n// Test double of Laravel Nova: public signatures only, not Laravel Nova.\n\nnamespace {$ns};\n\n";
    foreach ($imports as $alias => $fqn) {
        $short = preg_replace('/^(function|const) /', '', $alias);
        $plain = preg_replace('/^(function|const) /', '', $fqn);
        $kind = str_starts_with($alias, 'function ') ? 'function ' : (str_starts_with($alias, 'const ') ? 'const ' : '');
        $last = substr($plain, (int) strrpos('\\' . $plain, '\\'));
        $src .= "use {$kind}{$plain}" . ($last !== $short ? " as {$short}" : '') . ";\n";
    }
    if ($imports !== []) {
        $src .= "\n";
    }
    $src .= docTags($r->getDocComment(), '');
    if ($r->isEnum()) {
        $e = new ReflectionEnum($name);
        $backing = $e->getBackingType();
        $src .= "enum {$r->getShortName()}" . ($backing ? ': ' . $backing : '') . "\n{\n";
        foreach ($e->getCases() as $case) {
            $src .= '    case ' . $case->getName() . ($case instanceof ReflectionEnumBackedCase ? ' = ' . var_export($case->getBackingValue(), true) : '') . ";\n";
        }
    } else {
        $kind = $r->isInterface() ? 'interface' : ($r->isTrait() ? 'trait' : 'class');
        $mods = $kind === 'class' ? ($r->isFinal() ? 'final ' : '') . ($r->isAbstract() ? 'abstract ' : '') . ($r->isReadOnly() ? 'readonly ' : '') : '';
        $src .= $mods . $kind . ' ' . $r->getShortName();
        if ($r->isInterface()) {
            $inherited = [];
            foreach ($r->getInterfaceNames() as $iface) {
                $inherited = array_merge($inherited, (new ReflectionClass($iface))->getInterfaceNames());
            }
            $own = array_diff($r->getInterfaceNames(), $inherited);
            if ($own !== []) {
                $src .= ' extends ' . implode(', ', array_map(static fn (string $i): string => '\\' . $i, $own));
            }
        } else {
            if ($r->getParentClass() !== false) {
                $src .= ' extends \\' . $r->getParentClass()->getName();
            }
            $parentIfaces = $r->getParentClass() !== false ? $r->getParentClass()->getInterfaceNames() : [];
            $direct = array_values(array_diff($r->getInterfaceNames(), $parentIfaces));
            $inherited = [];
            foreach ($direct as $iface) {
                $inherited = array_merge($inherited, (new ReflectionClass($iface))->getInterfaceNames());
            }
            $direct = array_values(array_diff($direct, $inherited));
            if ($direct !== []) {
                $src .= ' implements ' . implode(', ', array_map(static fn (string $i): string => '\\' . $i, $direct));
            }
        }
        $src .= "\n{\n";
    }
    foreach ($r->getReflectionConstants() as $c) {
        if ($c->getDeclaringClass()->getName() !== $name || ($r->isEnum() && $c->isEnumCase())) {
            continue;
        }
        $vis = $c->isPublic() ? 'public' : ($c->isProtected() ? 'protected' : 'private');
        $src .= docTags($c->getDocComment(), '    ') . '    ' . ($c->isFinal() && ! $r->isInterface() ? 'final ' : '') . $vis . ' const ' . ($c->hasType() ? $c->getType() . ' ' : '') . $c->getName() . ' = ' . exportValue($c->getValue()) . ";\n";
    }
    if (! $r->isInterface() && ! $r->isEnum()) {
        $defaults = $r->getDefaultProperties();
        foreach ($r->getProperties() as $p) {
            if ($p->getDeclaringClass()->getName() !== $name || $p->isPromoted()) {
                continue;
            }
            $vis = $p->isPublic() ? 'public' : ($p->isProtected() ? 'protected' : 'private');
            $type = typeString($p->getType());
            $line = '    ' . $vis . ($p->isStatic() ? ' static' : '') . ($p->isReadOnly() ? ' readonly' : '') . ($type !== '' ? ' ' . $type : '') . ' $' . $p->getName();
            if ($p->hasDefaultValue() && ! $p->isReadOnly()) {
                $default = $p->isStatic() ? $p->getDefaultValue() : ($defaults[$p->getName()] ?? null);
                if ($default !== null || $type === '' || str_starts_with($type, '?')) {
                    try {
                        $line .= ' = ' . exportValue($default);
                    } catch (RuntimeException) {
                        $line .= $type === '' || str_starts_with($type, '?') ? ' = null' : '';
                    }
                }
            }
            $src .= docTags($p->getDocComment(), '    ') . $line . ";\n";
        }
    }
    foreach ($methods as $m) {
        if ($r->isEnum() && in_array($m->getName(), ['cases', 'from', 'tryFrom'], true)) {
            continue;
        }
        $vis = $m->isPublic() ? 'public' : ($m->isProtected() ? 'protected' : 'private');
        $mods = ($m->isFinal() && ! $r->isEnum() ? 'final ' : '') . ($m->isAbstract() && ! $r->isInterface() ? 'abstract ' : '') . $vis . ($m->isStatic() ? ' static' : '');
        $ret = typeString($m->getReturnType());
        $attrs = $m->getAttributes(ReturnTypeWillChange::class) !== [] ? "    #[\\ReturnTypeWillChange]\n" : '';
        $sig = '    ' . $mods . ' function ' . ($m->returnsReference() ? '&' : '') . $m->getName() . '(' . implode(', ', array_map('paramString', $m->getParameters())) . ')' . ($ret !== '' ? ': ' . $ret : '');
        $key = $name . '::' . $m->getName();
        $src .= docTags($m->getDocComment(), '    ') . $attrs . $sig . bodyFor($m, $overrides[$key] ?? null);
    }
    if (isset($overrides[$name . '::@extra'])) {
        $src .= rtrim(preg_replace('/^/m', '    ', trim($overrides[$name . '::@extra'], "\n")) ?? '') . "\n";
    }
    $src .= "}\n";
    $path = $out . '/src/' . str_replace('\\', '/', substr($name, strlen(NOVA))) . '.php';
    @mkdir(dirname($path), 0777, true);
    file_put_contents($path, $src);
}

fwrite(STDERR, sprintf("%d classes written, %d referenced names not found\n", count($done), count($skipped)));
