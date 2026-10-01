<?php

// Test double of Laravel Nova: public signatures only, not Laravel Nova.

namespace Laravel\Nova\Fields;

class Hidden extends \Laravel\Nova\Fields\Text
{
    /**
     * @var string
     */
    public $component = 'hidden-field';
    /**
     * @param  \Stringable|string  $name
     * @param  string|callable|null  $attribute
     * @param  (callable(mixed, mixed, ?string):(mixed))|null  $resolveCallback
     */
    public function __construct($name, mixed $attribute = null, ?callable $resolveCallback = null) {
    }
}
