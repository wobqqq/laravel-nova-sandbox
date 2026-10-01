<?php

declare(strict_types=1);

namespace App\Support;

use Composer\InstalledVersions;

/**
 * The packages composer installed from a local path repository, i.e. whose
 * code lives outside vendor/.
 */
final readonly class LocalPackages
{
    /**
     * @param array<string, string|null> $installPaths package name => install path
     */
    public function __construct(
        private array $installPaths,
        private string $vendorDir,
    ) {
    }

    public static function fromComposer(): self
    {
        $paths = [];

        foreach (InstalledVersions::getInstalledPackages() as $name) {
            $paths[$name] = InstalledVersions::getInstallPath($name);
        }

        return new self($paths, base_path('vendor'));
    }

    /**
     * @return list<array{name: string, path: string}>
     */
    public function all(): array
    {
        $vendor = realpath($this->vendorDir);
        $packages = [];

        foreach ($this->installPaths as $name => $path) {
            $real = $path === null ? false : realpath($path);

            if ($real === false || ($vendor !== false && str_starts_with($real, $vendor . DIRECTORY_SEPARATOR))) {
                continue;
            }

            $packages[] = ['name' => $name, 'path' => $real];
        }

        usort($packages, fn (array $a, array $b): int => $a['name'] <=> $b['name']);

        return $packages;
    }
}
