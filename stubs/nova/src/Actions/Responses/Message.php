<?php

// Test double of Laravel Nova: public signatures only, not Laravel Nova.

namespace Laravel\Nova\Actions\Responses;

use JsonSerializable;
use Stringable;

class Message implements \JsonSerializable, \Stringable
{
    public function __construct(public \Stringable|string $text) {
    }
    public function __toString(): string {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    #[\ReturnTypeWillChange]
    public function jsonSerialize(): string {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
}
