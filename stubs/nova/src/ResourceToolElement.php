<?php

// Test double of Laravel Nova: public signatures only, not Laravel Nova.

namespace Laravel\Nova;

use Laravel\Nova\Fields\FieldElement;

class ResourceToolElement extends \Laravel\Nova\Fields\FieldElement
{
    public function __construct(?string $component = null) {
    }
}
