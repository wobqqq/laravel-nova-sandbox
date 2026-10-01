<?php

// Test double of Laravel Nova: public signatures only, not Laravel Nova.

namespace Laravel\Nova\Support;

use Illuminate\Support\Arr;
use Laravel\Nova\Makeable;

class Fluent extends \Illuminate\Support\Fluent
{
    /**
     * @param  array<string, mixed>  $attributes
     * @return $this
     */
    public function fill($attributes) {
        return $this;
    }
    /**
     * @param  array<string, mixed>  $attributes
     * @return $this
     */
    public function forceFill($attributes) {
        return $this;
    }
    /**
     * @param  string  $key
     * @param  mixed  $default
     * @return mixed
     */
    public function value($key, $default = null) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return static
     */
    public static function make(...$arguments) {
        return new static(...$arguments);
    }
}
