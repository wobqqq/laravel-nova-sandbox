<?php

// Test double of Laravel Nova: public signatures only, not Laravel Nova.

namespace Laravel\Nova\Fields;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Laravel\Nova\Http\Requests\NovaRequest;

class Password extends \Laravel\Nova\Fields\Field
{
    /**
     * @var string
     */
    public $component = 'password-field';
    /**
     * @var array<int, \Laravel\Nova\Fields\Dependent>
     */
    protected $fieldDependencies = [];
    /**
     * @param  \Stringable|string  $name
     * @param  string|callable|object|null  $attribute
     * @param  (callable(mixed, mixed, ?string):(mixed))|null  $resolveCallback
     */
    public function __construct($name, mixed $attribute = null, ?callable $resolveCallback = null) {
    }
    /**
     * @param  \Laravel\Nova\Resource|\Illuminate\Database\Eloquent\Model|object|array  $resource
     */
    protected function resolveAttribute($resource, string $attribute): mixed {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    public function resolveForAction(\Laravel\Nova\Http\Requests\NovaRequest $request): void {
    }
    /**
     * @param  \Laravel\Nova\Resource|\Illuminate\Database\Eloquent\Model|object|array  $resource
     */
    public function resolveForDisplay($resource, ?string $attribute = null): void {
    }
    /**
     * @param  \Illuminate\Database\Eloquent\Model|\Laravel\Nova\Support\Fluent  $model
     */
    public function fillModelWithData(object $model, mixed $value, string $attribute): void {
    }
    protected function defaultDisabledAutoCompleteValue(): string {
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
