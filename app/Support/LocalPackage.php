<?php

declare(strict_types=1);

namespace App\Support;

final readonly class LocalPackage
{
    public function __construct(
        public string $name,
        public string $path,
    ) {
    }
}
