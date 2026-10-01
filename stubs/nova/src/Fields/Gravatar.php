<?php

// Test double of Laravel Nova: public signatures only, not Laravel Nova.

namespace Laravel\Nova\Fields;

use Laravel\Nova\Nova;

/**
 * @method static static make(\Stringable|string|null $name = null, string $attribute = 'email')
 */
class Gravatar extends \Laravel\Nova\Fields\Avatar implements \Laravel\Nova\Fields\Unfillable
{
    /**
     * @param  \Stringable|string|null  $name
     */
    public function __construct($name = null, string $attribute = 'email') {
    }
    /**
     * @param  \Laravel\Nova\Resource|\Illuminate\Database\Eloquent\Model|object  $resource
     */
    protected function resolveAttribute($resource, string $attribute): string {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return array<string, mixed>
     */
    public function jsonSerialize(): array {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
}
