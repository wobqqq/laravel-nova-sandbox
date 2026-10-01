<?php

// Test double of Laravel Nova: public signatures only, not Laravel Nova.

namespace Laravel\Nova\Actions\Responses;

use JsonSerializable;
use Laravel\Nova\URL;

class Visit implements \JsonSerializable
{
    public function __construct(public \Laravel\Nova\URL|string $path, public array $options = []) {
    }
    /**
     * @return array{path: string, options: array<string, mixed>}
     */
    public function jsonSerialize(): array {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
}
