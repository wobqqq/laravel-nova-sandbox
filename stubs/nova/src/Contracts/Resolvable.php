<?php

// Test double of Laravel Nova: public signatures only, not Laravel Nova.

namespace Laravel\Nova\Contracts;

/**
 * @property bool $pivot
 * @property string|null $pivotAccessor
 * @property \Illuminate\Database\Eloquent\Relations\MorphToMany|\Illuminate\Database\Eloquent\Relations\BelongsToMany|null $pivotRelation
 */
interface Resolvable
{
    /**
     * @param  \Illuminate\Database\Eloquent\Model|\Laravel\Nova\Support\Fluent|object|array  $resource
     */
    public function resolve($resource, ?string $attribute = null): void;
    /**
     * @param  \Illuminate\Database\Eloquent\Model|\Laravel\Nova\Support\Fluent|object|array  $resource
     */
    public function resolveForDisplay($resource, ?string $attribute = null): void;
}
