<?php

// Test double of Laravel Nova: public signatures only, not Laravel Nova.

namespace Laravel\Nova\Actions\Responses;

use JsonSerializable;

class Modal implements \JsonSerializable
{
    /**
     * @param  array<string, mixed>  $payload
     */
    public function __construct(public string $component, public array $payload = []) {
    }
    /**
     * @return array{component: string, payload: array<string, mixed>}
     */
    public function jsonSerialize(): array {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
}
