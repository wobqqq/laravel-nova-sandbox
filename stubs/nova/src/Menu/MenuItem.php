<?php

// Test double of Laravel Nova: public signatures only, not Laravel Nova.

namespace Laravel\Nova\Menu;

use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Traits\Conditionable;
use Illuminate\Support\Traits\Macroable;
use InvalidArgumentException;
use JsonSerializable;
use Laravel\Nova\AuthorizedToSee;
use Laravel\Nova\Contracts\Filter as FilterContract;
use Laravel\Nova\Filters\Filter;
use Laravel\Nova\Filters\FilterEncoder;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Makeable;
use Laravel\Nova\Nova;
use Laravel\Nova\Resource;
use Laravel\Nova\URL;
use Laravel\Nova\WithBadge;
use Laravel\Nova\WithComponent;
use Stringable;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\HigherOrderWhenProxy;
use BadMethodCallException;
use ReflectionClass;
use ReflectionMethod;
use RuntimeException;
use Throwable;
use function Orchestra\Sidekick\is_safe_callable;

/**
 * @method static static make(\Stringable|string $name, string|null $path = null)
 */
class MenuItem implements \JsonSerializable
{
    /**
     * @var string
     */
    public $component = 'menu-item';
    /**
     * @var string
     */
    public $method = 'GET';
    /**
     * @var array<string, string>|null
     */
    public $data = null;
    /**
     * @var array<string, string>|null
     */
    public $headers = null;
    /**
     * @var bool
     */
    public $external = false;
    /**
     * @var string|null
     */
    public $target = null;
    /**
     * @var (callable(\Illuminate\Http\Request, \Laravel\Nova\URL):bool)|bool|null
     */
    public $activeMenuCallback = null;
    /**
     * @var class-string<\Laravel\Nova\Resource>|null
     */
    public $resource = null;
    public \Illuminate\Support\Collection $filters;
    /**
     * @var (\Closure(\Laravel\Nova\Http\Requests\NovaRequest|\Illuminate\Http\Request):(bool))|null
     */
    public $seeCallback = null;
    /**
     * @var array
     */
    protected static $macros = [];
    /**
     * @var (\Closure():(\Laravel\Nova\Badge|string|false))|(callable():(\Laravel\Nova\Badge|string|false))|\Laravel\Nova\Badge|string|false|null
     */
    public $badgeCallback = null;
    /**
     * @var string
     */
    public $badgeType = 'info';
    public function __construct(public \Stringable|string $name, public ?string $path = null) {
    }
    /**
     * @param  class-string<\Laravel\Nova\Resource>  $resourceClass
     * @return static
     */
    public static function resource(string $resourceClass) {
        return new static();
    }
    /**
     * @param  class-string<\Laravel\Nova\Resource>  $resourceClass
     * @param  class-string<\Laravel\Nova\Lenses\Lens>  $lensClass
     * @return static
     */
    public static function lens(string $resourceClass, string $lensClass) {
        return new static();
    }
    /**
     * @param  class-string<\Laravel\Nova\Resource>  $resourceClass
     * @param  mixed|null  $value
     * @return static
     */
    public static function filter(\Stringable|string $name, string $resourceClass, \Laravel\Nova\Contracts\Filter|string|null $filter = null, $value = null) {
        return new static();
    }
    /**
     * @return $this
     */
    public function applies(\Laravel\Nova\Contracts\Filter|string $filter, mixed $value) {
        return $this;
    }
    /**
     * @param  class-string<\Laravel\Nova\Resource>  $resourceClass
     * @return $this
     */
    protected function forResource(string $resourceClass) {
        return $this;
    }
    protected function queryString(): string {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    public function encodedFilters(): string {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return $this
     */
    public function path(\Laravel\Nova\URL|string|null $href) {
        return $this;
    }
    /**
     * @param  class-string<\Laravel\Nova\Dashboard>  $dashboard
     * @return static
     */
    public static function dashboard(string $dashboard) {
        return new static();
    }
    /**
     * @return static
     */
    public static function link(\Stringable|string $name, string $path) {
        return new static();
    }
    /**
     * @return static
     */
    public static function externalLink(\Stringable|string $name, string $path) {
        return new static();
    }
    /**
     * @return $this
     */
    public function external() {
        return $this;
    }
    /**
     * @return $this
     */
    public function openInNewTab() {
        return $this;
    }
    /**
     * @param  array<string, mixed>|null  $data
     * @param  array<string, string>|null  $headers
     * @return $this
     */
    public function method(string $method, ?array $data = null, ?array $headers = null) {
        return $this;
    }
    /**
     * @param  array<string, mixed>|null  $data
     * @param  array<string, string>|null  $headers
     * @return static
     */
    public function inertia(string $method = 'GET', ?array $data = null, ?array $headers = null) {
        return $this;
    }
    /**
     * @param  array<string, string>|null  $headers
     * @return $this
     */
    public function headers(?array $headers = null) {
        return $this;
    }
    /**
     * @param  array<string, string>|null  $data
     * @return $this
     */
    public function data(?array $data = null) {
        return $this;
    }
    /**
     * @return $this
     */
    public function name(\Stringable|string $name) {
        return $this;
    }
    /**
     * @param  (callable(\Illuminate\Http\Request, \Laravel\Nova\URL):bool)|bool  $activeMenuCallback
     * @return $this
     */
    public function activeWhen(callable|bool $activeMenuCallback) {
        return $this;
    }
    /**
     * @param  (callable(\Illuminate\Http\Request, \Laravel\Nova\URL):bool)|bool  $activeMenuCallback
     * @return $this
     */
    public function activeUnless(callable|bool $activeMenuCallback) {
        return $this;
    }
    /**
     * @return array<string, mixed>
     */
    public function jsonSerialize(): array {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return bool
     */
    public function authorizedToSee(\Illuminate\Http\Request $request) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  \Closure(\Laravel\Nova\Http\Requests\NovaRequest|\Illuminate\Http\Request):bool  $callback
     * @return $this
     */
    public function canSee(\Closure $callback) {
        return $this;
    }
    /**
     * @template TWhenParameter
     * @template TWhenReturnType
     * @param  (\Closure($this): TWhenParameter)|TWhenParameter|null  $value
     * @param  (callable($this, TWhenParameter): TWhenReturnType)|null  $callback
     * @param  (callable($this, TWhenParameter): TWhenReturnType)|null  $default
     * @return $this|TWhenReturnType
     */
    public function when($value = null, ?callable $callback = null, ?callable $default = null) {
        return $this;
    }
    /**
     * @template TUnlessParameter
     * @template TUnlessReturnType
     * @param  (\Closure($this): TUnlessParameter)|TUnlessParameter|null  $value
     * @param  (callable($this, TUnlessParameter): TUnlessReturnType)|null  $callback
     * @param  (callable($this, TUnlessParameter): TUnlessReturnType)|null  $default
     * @return $this|TUnlessReturnType
     */
    public function unless($value = null, ?callable $callback = null, ?callable $default = null) {
        return $this;
    }
    /**
     * @param  string  $name
     * @param  object|callable  $macro
     * @param-closure-this static  $macro
     * @return void
     */
    public static function macro($name, $macro) {
    }
    /**
     * @param  object  $mixin
     * @param  bool  $replace
     * @return void
     * @throws \ReflectionException
     */
    public static function mixin($mixin, $replace = true) {
    }
    /**
     * @param  string  $name
     * @return bool
     */
    public static function hasMacro($name) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return void
     */
    public static function flushMacros() {
    }
    /**
     * @param  string  $method
     * @param  array  $parameters
     * @return mixed
     * @throws \BadMethodCallException
     */
    public static function __callStatic($method, $parameters) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  string  $method
     * @param  array  $parameters
     * @return mixed
     * @throws \BadMethodCallException
     */
    public function __call($method, $parameters) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return static
     */
    public static function make(...$arguments) {
        return new static(...$arguments);
    }
    /**
     * @param  \Laravel\Nova\Badge|(callable():(\Laravel\Nova\Badge|string|false))|string  $badgeCallback
     * @return $this
     */
    public function withBadge(\Laravel\Nova\Badge|callable|string $badgeCallback, string $type = 'info') {
        return $this;
    }
    /**
     * @param  \Laravel\Nova\Badge|(callable():(\Laravel\Nova\Badge|string|false))|string  $badgeCallback
     * @param  (\Closure():(bool))|bool  $condition
     * @return $this
     */
    public function withBadgeIf(\Laravel\Nova\Badge|callable|string $badgeCallback, string $type, \Closure|bool $condition) {
        return $this;
    }
    /**
     * @throws \Exception
     */
    public function resolveBadge(): ?\Laravel\Nova\Badge {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return string
     */
    public function component() {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return $this
     */
    public function withComponent(string $component) {
        return $this;
    }
}
