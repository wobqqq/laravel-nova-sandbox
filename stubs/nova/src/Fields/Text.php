<?php

// Test double of Laravel Nova: public signatures only, not Laravel Nova.

namespace Laravel\Nova\Fields;

use Illuminate\Support\Arr;
use Laravel\Nova\Contracts\FilterableField;
use Laravel\Nova\Fields\Filters\TextFilter;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Exceptions\HelperNotSupported;
use Closure;
use InvalidArgumentException;

class Text extends \Laravel\Nova\Fields\Field implements \Laravel\Nova\Contracts\FilterableField
{
    /**
     * @var string
     */
    public $component = 'text-field';
    /**
     * @var bool
     */
    public $asHtml = false;
    /**
     * @var bool
     */
    public $asEncodedHtml = false;
    /**
     * @var bool
     */
    public $copyable = false;
    /**
     * @var (callable(\Laravel\Nova\Http\Requests\NovaRequest, \Illuminate\Contracts\Database\Eloquent\Builder, mixed, string):(void))|null
     */
    public $filterableCallback = null;
    /**
     * @var (callable():(iterable))|iterable|null
     */
    public $suggestions = null;
    /**
     * @var array<int, \Laravel\Nova\Fields\Dependent>
     */
    protected $fieldDependencies = [];
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
     * @return array<string, mixed>
     */
    public function jsonSerialize(): array {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return $this
     * @throws \Laravel\Nova\Exceptions\HelperNotSupported
     */
    public function asHtml() {
        return $this;
    }
    /**
     * @return $this
     * @throws \Laravel\Nova\Exceptions\HelperNotSupported
     */
    public function asEncodedHtml() {
        return $this;
    }
    public function serializeDisplayedValueAsHtml(\Laravel\Nova\Http\Requests\NovaRequest $request): ?string {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return $this
     * @throws \Laravel\Nova\Exceptions\HelperNotSupported
     */
    public function copyable() {
        return $this;
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
     * @param  (callable():(iterable))|iterable  $suggestions
     * @return $this
     */
    public function suggestions(\Traversable|callable|array $suggestions) {
        return $this;
    }
    public function resolveSuggestions(\Laravel\Nova\Http\Requests\NovaRequest $request): ?iterable {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return $this
     */
    public function withAutoCompletion(array|string|bool $value = true) {
        return $this;
    }
    /**
     * @return $this
     */
    public function withoutAutoCompletion() {
        return $this;
    }
    /**
     * @return $this
     */
    public function autocomplete(array|string|bool $value) {
        return $this;
    }
    protected function defaultEnabledAutoCompleteValue(): string {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    protected function defaultDisabledAutoCompleteValue(): string {
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
    /**
     * @return $this
     */
    public function maxlength(int $value, bool $enforce = false) {
        return $this;
    }
    /**
     * @return $this
     */
    public function enforceMaxlength() {
        return $this;
    }
}
