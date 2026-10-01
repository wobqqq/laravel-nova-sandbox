<?php

// Test double of Laravel Nova: public signatures only, not Laravel Nova.

namespace Laravel\Nova\Fields;

use Illuminate\Support\Collection;
use Illuminate\Support\Fluent;

class ResolvedFields extends \Illuminate\Support\Fluent
{
    /**
     * @var \Illuminate\Support\Collection
     */
    public $callbacks = null;
    public function __construct(\Illuminate\Support\Collection $attributes, \Illuminate\Support\Collection $callbacks) {
    }
    public function callbacks(): \Illuminate\Support\Collection {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
}
