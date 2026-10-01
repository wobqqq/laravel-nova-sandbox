<?php

// Test double of Laravel Nova: public signatures only, not Laravel Nova.

namespace Laravel\Nova\Support;

/**
 * @internal
 */
class UndefinedValue implements \JsonSerializable
{
    public static function equalsTo(mixed $value): bool {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return null
     */
    #[\ReturnTypeWillChange]
    public function jsonSerialize() {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
}
