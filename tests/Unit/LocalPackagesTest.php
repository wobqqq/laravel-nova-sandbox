<?php

declare(strict_types=1);

use App\Support\LocalPackages;
use Illuminate\Support\Facades\File;

function localPackagesRoot(): string
{
    return sys_get_temp_dir() . '/local-packages-test';
}

beforeEach(function (): void {
    $root = localPackagesRoot();

    File::deleteDirectory($root);

    foreach (['vendor/acme/remote', 'packages/zeta', 'packages/alpha'] as $dir) {
        File::makeDirectory("{$root}/{$dir}", 0o755, true);
    }

    symlink("{$root}/packages/alpha", "{$root}/vendor/acme/alpha");
});

afterEach(function (): void {
    File::deleteDirectory(localPackagesRoot());
});

it('keeps only the packages whose code lives outside vendor, by name', function (): void {
    $root = localPackagesRoot();

    $packages = new LocalPackages([
        'acme/remote' => "{$root}/vendor/acme/remote",
        'acme/zeta' => "{$root}/packages/zeta",
        'acme/alpha' => "{$root}/vendor/acme/alpha",
        'acme/meta' => null,
        'acme/gone' => "{$root}/vendor/acme/gone",
    ], "{$root}/vendor");

    expect($packages->all())->toBe([
        ['name' => 'acme/alpha', 'path' => "{$root}/packages/alpha"],
        ['name' => 'acme/zeta', 'path' => "{$root}/packages/zeta"],
    ]);
});

it('reads the installed packages from composer', function (): void {
    $names = array_column(LocalPackages::fromComposer()->all(), 'name');

    expect($names)->not->toContain('laravel/framework', 'laravel/nova');
});
