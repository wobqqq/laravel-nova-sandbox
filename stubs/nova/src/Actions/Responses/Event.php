<?php

// Test double of Laravel Nova: public signatures only, not Laravel Nova.

namespace Laravel\Nova\Actions\Responses;

use JsonSerializable;

class Event implements \JsonSerializable
{
    public function __construct(public string $key, public array $payload = []) {
    }
    /**
     * @return array{key: string, payload: array<string, mixed>}
     */
    public function jsonSerialize(): array {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
}
