<?php

// Test double of Laravel Nova: public signatures only, not Laravel Nova.

namespace Laravel\Nova\Contracts;

use Laravel\Nova\Http\Requests\NovaRequest;

/**
 * @mixin \Laravel\Nova\Fields\Field
 * @property bool $allowDuplicateRelations
 * @property string $manyToManyRelationship
 */
interface PivotableField extends \Laravel\Nova\Contracts\RelatableField
{
    public function buildAttachableQuery(\Laravel\Nova\Http\Requests\NovaRequest $request, bool $withTrashed = false): \Laravel\Nova\Contracts\QueryBuilder;
    /**
     * @param  \Laravel\Nova\Resource|\Illuminate\Database\Eloquent\Model  $resource
     */
    public function formatAttachableResource(\Laravel\Nova\Http\Requests\NovaRequest $request, $resource): array;
    public function shouldReorderAttachableValues(\Laravel\Nova\Http\Requests\NovaRequest $request): bool;
}
