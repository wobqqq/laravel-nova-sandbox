<?php

// Test double of Laravel Nova: public signatures only, not Laravel Nova.

namespace Laravel\Nova\Contracts;

/**
 * @mixin \Laravel\Nova\Fields\Field
 */
interface ListableField extends \Laravel\Nova\Contracts\BehavesAsPanel
{
}
