<?php

// Test double of Laravel Nova: public signatures only, not Laravel Nova.

namespace Laravel\Nova;

class Script extends \Laravel\Nova\Asset
{
    public function url(): string {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return array<string, string>
     */
    public function toResponseHeaders(): array {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
}
