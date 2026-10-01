<?php

// Test double of Laravel Nova: public signatures only, not Laravel Nova.

namespace Laravel\Nova\Fields;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\MissingValue;
use Illuminate\Support\Collection;
use Illuminate\Support\LazyCollection;
use Laravel\Nova\Contracts\FilterableField;
use Laravel\Nova\Contracts\ListableField;
use Laravel\Nova\Contracts\PivotableField;
use Laravel\Nova\Contracts\RelatableField;
use Laravel\Nova\Contracts\Resolvable;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Panel;
use Laravel\Nova\ResourceTool;
use Laravel\Nova\ResourceToolElement;
use Stringable;
use function Orchestra\Sidekick\Eloquent\normalize_value;

/**
 * @template TKey of int
 * @template TValue of \Laravel\Nova\Panel|\Laravel\Nova\ResourceToolElement|\Laravel\Nova\Fields\Field|\Illuminate\Http\Resources\MissingValue
 * @extends \Illuminate\Support\Collection<TKey, TValue>
 */
class FieldCollection extends \Illuminate\Support\Collection
{
    /**
     * @return static<TKey, TValue>
     */
    public function assignDefaultPanel(\Stringable|string $label) {
        return $this;
    }
    /**
     * @return static<int, TValue>
     */
    public function flattenStackedFields() {
        return $this;
    }
    /**
     * @template TGetDefault
     * @param  TGetDefault|(\Closure():(TGetDefault))  $default
     * @return TValue|TGetDefault
     */
    public function findFieldByAttribute(string $attribute, mixed $default = null) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return TValue
     */
    public function findFieldByAttributeOrFail(string $attribute) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return static<int, TValue>
     */
    public function authorized(\Illuminate\Http\Request $request) {
        return $this;
    }
    /**
     * @param  \Illuminate\Database\Eloquent\Model|\Laravel\Nova\Support\Fluent|object|array  $resource
     * @return static<int, TValue>
     */
    public function resolve($resource) {
        return $this;
    }
    /**
     * @param  \Illuminate\Database\Eloquent\Model|\Laravel\Nova\Support\Fluent|object|array  $resource
     * @return static<int, TValue>
     */
    public function resolveForDisplay($resource) {
        return $this;
    }
    /**
     * @param  \Illuminate\Database\Eloquent\Model|object  $resource
     * @return static<int, \Laravel\Nova\Fields\Field>
     */
    public function onlyCreateFields(\Laravel\Nova\Http\Requests\NovaRequest $request, $resource) {
        return $this;
    }
    /**
     * @param  \Illuminate\Database\Eloquent\Model|object  $resource
     * @return static<int, \Laravel\Nova\Fields\Field>
     */
    public function onlyUpdateFields(\Laravel\Nova\Http\Requests\NovaRequest $request, $resource) {
        return $this;
    }
    /**
     * @param  \Illuminate\Database\Eloquent\Model|object  $resource
     * @return static<int, \Laravel\Nova\Fields\Field>
     */
    public function filterForDetail(\Laravel\Nova\Http\Requests\NovaRequest $request, $resource) {
        return $this;
    }
    /**
     * @param  \Illuminate\Database\Eloquent\Model|object  $resource
     * @return static<int, \Laravel\Nova\Fields\Field>
     */
    public function filterForPreview(\Laravel\Nova\Http\Requests\NovaRequest $request, $resource) {
        return $this;
    }
    /**
     * @return static<int, \Laravel\Nova\Fields\Field>
     */
    public function filterForPeeking(\Laravel\Nova\Http\Requests\NovaRequest $request) {
        return $this;
    }
    /**
     * @param  \Illuminate\Database\Eloquent\Model|\Laravel\Nova\Support\Fluent|object|array  $resource
     * @return static<int, \Laravel\Nova\Fields\Field>
     */
    public function filterForIndex(\Laravel\Nova\Http\Requests\NovaRequest $request, $resource) {
        return $this;
    }
    /**
     * @return static<int, TValue>
     */
    public function withoutComputed(\Laravel\Nova\Http\Requests\NovaRequest $request) {
        return $this;
    }
    /**
     * @return static<int, TValue>
     */
    public function withoutReadonly(\Laravel\Nova\Http\Requests\NovaRequest $request) {
        return $this;
    }
    /**
     * @return static<int, \Laravel\Nova\Panel|\Laravel\Nova\ResourceToolElement|\Laravel\Nova\Fields\Field>
     */
    public function withoutMissingValues() {
        return $this;
    }
    /**
     * @return static<int, TValue>
     */
    public function withoutListableFields() {
        return $this;
    }
    /**
     * @return static<int, TValue>
     */
    public function withoutUnfillable() {
        return $this;
    }
    /**
     * @return static<int, TValue>
     */
    public function withoutResourceTools() {
        return $this;
    }
    /**
     * @return static<TKey, \Laravel\Nova\Fields\Field&\Laravel\Nova\Contracts\PivotableField>
     */
    public function filterForManyToManyRelations() {
        return $this;
    }
    /**
     * @return static<TKey, \Laravel\Nova\Fields\Field&\Laravel\Nova\Contracts\FilterableField>
     */
    public function withOnlyFilterableFields() {
        return $this;
    }
    /**
     * @return $this
     */
    public function applyDependsOn(\Laravel\Nova\Http\Requests\NovaRequest $request) {
        return $this;
    }
    /**
     * @return $this
     */
    public function applyDependsOnWithDefaultValues(\Laravel\Nova\Http\Requests\NovaRequest $request) {
        return $this;
    }
}
