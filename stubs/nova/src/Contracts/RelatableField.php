<?php

// Test double of Laravel Nova: public signatures only, not Laravel Nova.

namespace Laravel\Nova\Contracts;

/**
 * @mixin \Laravel\Nova\Fields\Field
 * @property string $attribute
 * @property \Laravel\Nova\Resource $resourceClass
 * @property string $resourceName
 */
interface RelatableField
{
    /**
     * @return string
     */
    public function relationshipName();
    /**
     * @return string
     */
    public function relationshipType();
}
