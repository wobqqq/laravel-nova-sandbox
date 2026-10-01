<?php

// Test double of Laravel Nova: public signatures only, not Laravel Nova.

namespace Laravel\Nova\Exceptions;

use Exception;

class ResourceMissingException extends \Exception
{
    /**
     * @param  \Illuminate\Database\Eloquent\Model  $model
     */
    public function __construct($model) {
    }
    public static function forRepeater(string $resource): static {
        return new static();
    }
}
