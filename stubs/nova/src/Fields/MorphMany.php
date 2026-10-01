<?php

// Test double of Laravel Nova: public signatures only, not Laravel Nova.

namespace Laravel\Nova\Fields;

class MorphMany extends \Laravel\Nova\Fields\HasMany
{
    public function relationshipType(): string {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
}
