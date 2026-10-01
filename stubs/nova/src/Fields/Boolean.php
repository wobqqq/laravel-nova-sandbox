<?php

// Test double of Laravel Nova: public signatures only, not Laravel Nova.

namespace Laravel\Nova\Fields;

use Illuminate\Support\Arr;
use Laravel\Nova\Contracts\FilterableField;
use Laravel\Nova\Fields\Filters\BooleanFilter;
use Laravel\Nova\Http\Requests\NovaRequest;
use Closure;
use InvalidArgumentException;

class Boolean extends \Laravel\Nova\Fields\Field implements \Laravel\Nova\Contracts\FilterableField
{
    /**
     * @var string
     */
    public $component = 'boolean-field';
    /**
     * @var string
     */
    public $textAlign = 'center';
    /**
     * @var mixed
     */
    public $trueValue = true;
    /**
     * @var mixed
     */
    public $falseValue = false;
    /**
     * @var (callable(\Laravel\Nova\Http\Requests\NovaRequest, \Illuminate\Contracts\Database\Eloquent\Builder, mixed, string):(void))|null
     */
    public $filterableCallback = null;
    /**
     * @var array<int, \Laravel\Nova\Fields\Dependent>
     */
    protected $fieldDependencies = [];
    /**
     * @param  \Laravel\Nova\Resource|\Illuminate\Database\Eloquent\Model|object  $resource
     */
    protected function resolveAttribute($resource, string $attribute): ?bool {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return \Laravel\Nova\Support\UndefinedValue|bool|null
     */
    public function resolveDefaultValue(\Laravel\Nova\Http\Requests\NovaRequest $request): mixed {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  \Illuminate\Database\Eloquent\Model|\Laravel\Nova\Support\Fluent  $model
     */
    protected function fillAttributeFromRequest(\Laravel\Nova\Http\Requests\NovaRequest $request, string $requestAttribute, object $model, string $attribute): void {
    }
    /**
     * @return $this
     */
    public function values(mixed $trueValue, mixed $falseValue) {
        return $this;
    }
    /**
     * @return $this
     */
    public function trueValue(mixed $value) {
        return $this;
    }
    /**
     * @return $this
     */
    public function falseValue(mixed $value) {
        return $this;
    }
    /**
     * @return \Laravel\Nova\Fields\Filters\Filter
     */
    protected function makeFilter(\Laravel\Nova\Http\Requests\NovaRequest $request) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    public function serializeForFilter(): array {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return string
     */
    protected function filterableAttribute(\Laravel\Nova\Http\Requests\NovaRequest $request) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  (callable(\Laravel\Nova\Http\Requests\NovaRequest, \Illuminate\Contracts\Database\Eloquent\Builder, mixed, string):(void))|null  $filterableCallback
     * @return $this
     */
    public function filterable(?callable $filterableCallback = null) {
        return $this;
    }
    /**
     * @return $this
     */
    public function withoutFilterable() {
        return $this;
    }
    /**
     * @param  \Illuminate\Contracts\Database\Eloquent\Builder  $query
     */
    public function applyFilter(\Laravel\Nova\Http\Requests\NovaRequest $request, $query, mixed $value): void {
    }
    /**
     * @return \Laravel\Nova\Fields\Filters\Filter|null
     */
    public function resolveFilter(\Laravel\Nova\Http\Requests\NovaRequest $request) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return callable(\Laravel\Nova\Http\Requests\NovaRequest, \Illuminate\Contracts\Database\Eloquent\Builder, mixed, string):\Illuminate\Contracts\Database\Eloquent\Builder
     */
    protected function defaultFilterableCallback() {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  \Laravel\Nova\Fields\Field|array<int, string|\Laravel\Nova\Fields\Field>|string  $attributes
     * @param  (callable(static, \Laravel\Nova\Http\Requests\NovaRequest, \Laravel\Nova\Fields\FormData):(void))|class-string  $mixin
     * @return $this
     */
    public function dependsOn(\Laravel\Nova\Fields\Field|array|string $attributes, callable|string $mixin) {
        return $this;
    }
    /**
     * @param  \Laravel\Nova\Fields\Field|array<int, string|\Laravel\Nova\Fields\Field>|string  $attributes
     * @param  (callable(static, \Laravel\Nova\Http\Requests\NovaRequest, \Laravel\Nova\Fields\FormData):(void))|class-string  $mixin
     * @return $this
     */
    public function dependsOnCreating(\Laravel\Nova\Fields\Field|array|string $attributes, callable|string $mixin) {
        return $this;
    }
    /**
     * @param  string|\Laravel\Nova\Fields\Field|array<int, string|\Laravel\Nova\Fields\Field>  $attributes
     * @param  (callable(static, \Laravel\Nova\Http\Requests\NovaRequest, \Laravel\Nova\Fields\FormData):(void))|class-string  $mixin
     * @return $this
     */
    public function dependsOnUpdating($attributes, $mixin) {
        return $this;
    }
}
