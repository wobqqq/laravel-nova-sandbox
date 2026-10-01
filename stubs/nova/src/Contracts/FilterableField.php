<?php

// Test double of Laravel Nova: public signatures only, not Laravel Nova.

namespace Laravel\Nova\Contracts;

use Laravel\Nova\Http\Requests\NovaRequest;

/**
 * @mixin \Laravel\Nova\Fields\Field
 * @method array jsonSerialize()
 * @property string $attribute
 * @property callable|null $filterableCallback
 * @property string $name
 * @property string $resourceClass
 */
interface FilterableField
{
    /**
     * @param  \Illuminate\Contracts\Database\Eloquent\Builder  $query
     */
    public function applyFilter(\Laravel\Nova\Http\Requests\NovaRequest $request, $query, mixed $value): void;
    /**
     * @return \Laravel\Nova\Fields\Filters\Filter|null
     */
    public function resolveFilter(\Laravel\Nova\Http\Requests\NovaRequest $request);
    public function serializeForFilter(): array;
}
