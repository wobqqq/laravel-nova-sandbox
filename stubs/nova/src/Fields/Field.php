<?php

// Test double of Laravel Nova: public signatures only, not Laravel Nova.

namespace Laravel\Nova\Fields;

use Closure;
use Illuminate\Support\Str;
use Illuminate\Support\Traits\Conditionable;
use Illuminate\Support\Traits\Tappable;
use JsonSerializable;
use Laravel\Nova\Contracts\Resolvable;
use Laravel\Nova\Exceptions\NovaException;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Metrics\HasHelpText;
use Laravel\Nova\Util;
use Stringable;
use function Orchestra\Sidekick\is_safe_callable;
use Illuminate\Support\HigherOrderWhenProxy;
use Laravel\Nova\Support\UndefinedValue;
use Illuminate\Contracts\Validation\InvokableRule;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Validation\Rule;
use Laravel\Nova\Metable;

/**
 * @phpstan-type TFieldValidationRules \Stringable|string|\Illuminate\Contracts\Validation\ValidationRule|\Illuminate\Contracts\Validation\Rule|\Illuminate\Contracts\Validation\InvokableRule|(callable(string, mixed, \Closure):(void))
 * @phpstan-type TValidationRules array<int, TFieldValidationRules>|TFieldValidationRules
 * @method static static make(\Stringable|string $name, string|callable|object|null $attribute = null, callable|null $resolveCallback = null)
 */
abstract class Field extends \Laravel\Nova\Fields\FieldElement implements \Laravel\Nova\Contracts\Resolvable
{
    public const LEFT_ALIGN = 'left';
    public const CENTER_ALIGN = 'center';
    public const RIGHT_ALIGN = 'right';
    /**
     * @var string
     */
    public $name = null;
    /**
     * @var string
     */
    public $attribute = null;
    /**
     * @var string|null
     */
    public $displayedAs = null;
    /**
     * @var (callable(mixed, mixed, string):(mixed))|null
     */
    public $displayCallback = null;
    /**
     * @var bool
     */
    public $usesCustomizedDisplay = false;
    /**
     * @var (callable(mixed, mixed, ?string):(mixed))|null
     */
    public $resolveCallback = null;
    /**
     * @var (callable(\Laravel\Nova\Http\Requests\NovaRequest, \Illuminate\Database\Eloquent\Model|\Laravel\Nova\Support\Fluent, string, string):(mixed))|null
     */
    public $fillCallback = null;
    /**
     * @var bool
     */
    public $sortable = false;
    /**
     * @var bool
     */
    public $nullable = false;
    /**
     * @var (callable():(array<int, mixed>|mixed))|array<int, mixed>|mixed
     */
    public $nullValues = [''];
    /**
     * @var bool
     */
    public $pivot = false;
    /**
     * @var string|null
     */
    public $pivotAccessor = null;
    /**
     * @var string
     */
    public $textAlign = 'left';
    /**
     * @var bool
     */
    public $wrapping = false;
    /**
     * @var bool
     */
    public $stacked = false;
    /**
     * @var array<class-string<\Laravel\Nova\Fields\Field>, string>
     */
    public static $customComponents = [];
    /**
     * @var (callable(\Laravel\Nova\Http\Requests\NovaRequest):(bool))|bool|null
     */
    public $requiredCallback = null;
    /**
     * @var \Laravel\Nova\Resource|\Illuminate\Database\Eloquent\Model|object|array
     */
    public $resource = null;
    /**
     * @var bool
     */
    public $visible = true;
    /**
     * @var string|null
     */
    public $placeholder = null;
    /**
     * @var bool
     */
    public $withLabel = true;
    /**
     * @var bool
     */
    public $inline = false;
    /**
     * @var bool
     */
    public $compact = false;
    protected ?bool $dependentShouldEmitChangesEvent;
    /**
     * @var string|null
     */
    public $validationAttribute = null;
    /**
     * @var (callable(\Laravel\Nova\Http\Requests\NovaRequest):(array|\Stringable|string|callable))|array|\Stringable|string
     * @phpstan-var (callable(\Laravel\Nova\Http\Requests\NovaRequest):TValidationRules)|TValidationRules
     */
    public $rules = [];
    /**
     * @var (callable(\Laravel\Nova\Http\Requests\NovaRequest):(array|\Stringable|string|callable))|array|\Stringable|string
     * @phpstan-var (callable(\Laravel\Nova\Http\Requests\NovaRequest):TValidationRules)|TValidationRules
     */
    public $creationRules = [];
    /**
     * @var (callable(\Laravel\Nova\Http\Requests\NovaRequest):(array|\Stringable|string|callable))|array|\Stringable|string
     * @phpstan-var (callable(\Laravel\Nova\Http\Requests\NovaRequest):TValidationRules)|TValidationRules
     */
    public $updateRules = [];
    /**
     * @var \Stringable|string|null
     */
    public $helpText = null;
    /**
     * @var string|int
     */
    public $helpWidth = 250;
    /**
     * @var mixed
     */
    public $value = null;
    /**
     * @var (callable(\Laravel\Nova\Http\Requests\NovaRequest):(bool))|bool|null
     */
    public $writableCallback = null;
    /**
     * @var bool|null
     */
    protected $isWritable = null;
    /**
     * @var (callable(mixed):(mixed))|null
     */
    protected $computedCallback = null;
    /**
     * @var (callable(\Laravel\Nova\Http\Requests\NovaRequest):(mixed))|null
     */
    protected $defaultCallback = null;
    /**
     * @var bool|null
     */
    protected $isReadonly = null;
    /**
     * @var (callable(\Laravel\Nova\Http\Requests\NovaRequest):(bool))|bool|null
     */
    public $readonlyCallback = null;
    /**
     * @var array<string, mixed>
     */
    public $meta = [];
    /**
     * @var (callable(\Laravel\Nova\Http\Requests\NovaRequest):(bool))|bool
     */
    public $showWhenPeeking = false;
    /**
     * @var (callable(\Laravel\Nova\Http\Requests\NovaRequest, \Illuminate\Database\Eloquent\Model|\Laravel\Nova\Support\Fluent|object|array):(bool))|bool
     */
    public $showOnPreview = false;
    /**
     * @var bool
     */
    public $fullWidth = false;
    /**
     * @param  \Stringable|string  $name
     * @param  string|callable|object|null  $attribute
     * @param  (callable(mixed, mixed, ?string):(mixed))|null  $resolveCallback
     */
    public function __construct($name, mixed $attribute = null, ?callable $resolveCallback = null) {
    }
    /**
     * @return $this
     */
    public function stacked() {
        return $this;
    }
    /**
     * @param  \Laravel\Nova\Resource|\Illuminate\Database\Eloquent\Model|object|array  $resource
     */
    public function resolveForDisplay($resource, ?string $attribute = null): void {
    }
    /**
     * @param  \Laravel\Nova\Resource|\Illuminate\Database\Eloquent\Model|object  $resource
     */
    protected function resolveUsingDisplayCallback(mixed $value, $resource, string $attribute): void {
    }
    /**
     * @param  \Laravel\Nova\Resource|\Illuminate\Database\Eloquent\Model|object|array  $resource
     */
    public function resolve($resource, ?string $attribute = null): void {
    }
    public function resolveForAction(\Laravel\Nova\Http\Requests\NovaRequest $request): void {
    }
    /**
     * @param  \Laravel\Nova\Resource|\Illuminate\Database\Eloquent\Model|object|array  $resource
     */
    protected function resolveAttribute($resource, string $attribute): mixed {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  callable(mixed, mixed, string):mixed  $displayCallback
     * @return $this
     */
    public function displayUsing(callable $displayCallback) {
        return $this;
    }
    /**
     * @param  callable(mixed, mixed, ?string):mixed  $resolveCallback
     * @return $this
     */
    public function resolveUsing(callable $resolveCallback) {
        return $this;
    }
    /**
     * @param  \Illuminate\Database\Eloquent\Model|\Laravel\Nova\Support\Fluent  $model
     * @return mixed
     */
    public function fill(\Laravel\Nova\Http\Requests\NovaRequest $request, object $model) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  \Illuminate\Database\Eloquent\Model|\Laravel\Nova\Support\Fluent  $model
     * @return mixed
     */
    public function fillForAction(\Laravel\Nova\Http\Requests\NovaRequest $request, object $model) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  \Illuminate\Database\Eloquent\Model|\Laravel\Nova\Support\Fluent  $model
     * @return mixed
     */
    public function fillInto(\Laravel\Nova\Http\Requests\NovaRequest $request, object $model, string $attribute, ?string $requestAttribute = null) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  \Illuminate\Database\Eloquent\Model|\Laravel\Nova\Support\Fluent  $model
     * @return mixed
     */
    protected function fillAttribute(\Laravel\Nova\Http\Requests\NovaRequest $request, string $requestAttribute, object $model, string $attribute) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  \Illuminate\Database\Eloquent\Model|\Laravel\Nova\Support\Fluent  $model
     * @return mixed
     */
    protected function fillAttributeFromRequest(\Laravel\Nova\Http\Requests\NovaRequest $request, string $requestAttribute, object $model, string $attribute) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  \Illuminate\Database\Eloquent\Model|\Laravel\Nova\Support\Fluent  $model
     */
    public function fillModelWithData(object $model, mixed $value, string $attribute): void {
    }
    protected function isNullable(): bool {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return $this
     */
    public function compact(bool $compact = true) {
        return $this;
    }
    protected function isNullValue(mixed $value): bool {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    public function isValidNullValue(mixed $value): bool {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    protected function valueIsConsideredNull(mixed $value): bool {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  (callable(\Laravel\Nova\Http\Requests\NovaRequest, \Illuminate\Database\Eloquent\Model|\Laravel\Nova\Support\Fluent, string, string):mixed)|null  $fillCallback
     * @return $this
     */
    public function fillUsing(?callable $fillCallback) {
        return $this;
    }
    /**
     * @return $this
     */
    public function sortable(bool $value = true) {
        return $this;
    }
    public function sortableUriKey(): string {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  (callable():(array<int, mixed>))|array<int, mixed>|mixed  $values
     * @return $this
     */
    public function nullable(bool $nullable = true, mixed $values = null) {
        return $this;
    }
    /**
     * @param  (callable():(array<int, mixed>))|array<int, mixed>|mixed  $values
     * @return $this
     */
    public function nullValues(mixed $values) {
        return $this;
    }
    /**
     * @return string
     */
    public function component() {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    public static function useComponent(string $component): void {
    }
    /**
     * @return $this
     */
    public function textAlign(string $alignment) {
        return $this;
    }
    /**
     * @param  (callable(\Laravel\Nova\Http\Requests\NovaRequest):(bool))|bool  $callback
     * @return $this
     */
    public function required(callable|bool $callback = true) {
        return $this;
    }
    public function isRequired(\Laravel\Nova\Http\Requests\NovaRequest $request): bool {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return never
     * @throws \Laravel\Nova\Exceptions\HelperNotSupported
     */
    public function helpWidth(string|int $helpWidth) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return never
     * @throws \Laravel\Nova\Exceptions\HelperNotSupported
     */
    public function getHelpWidth() {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return $this
     */
    public function placeholder(\Stringable|string|null $text) {
        return $this;
    }
    /**
     * @return $this
     */
    public function show() {
        return $this;
    }
    /**
     * @return $this
     */
    public function hide() {
        return $this;
    }
    /**
     * @return array<string, mixed>
     */
    public function jsonSerialize(): array {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @template TWhenParameter
     * @template TWhenReturnType
     * @param  (\Closure($this): TWhenParameter)|TWhenParameter|null  $value
     * @param  (callable($this, TWhenParameter): TWhenReturnType)|null  $callback
     * @param  (callable($this, TWhenParameter): TWhenReturnType)|null  $default
     * @return $this|TWhenReturnType
     */
    public function when($value = null, ?callable $callback = null, ?callable $default = null) {
        return $this;
    }
    /**
     * @template TUnlessParameter
     * @template TUnlessReturnType
     * @param  (\Closure($this): TUnlessParameter)|TUnlessParameter|null  $value
     * @param  (callable($this, TUnlessParameter): TUnlessReturnType)|null  $callback
     * @param  (callable($this, TUnlessParameter): TUnlessReturnType)|null  $default
     * @return $this|TUnlessReturnType
     */
    public function unless($value = null, ?callable $callback = null, ?callable $default = null) {
        return $this;
    }
    public function dependentComponentKey(): string {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    public function resolveDependentValue(\Laravel\Nova\Http\Requests\NovaRequest $request): mixed {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return $this
     */
    public function syncDependsOn(\Laravel\Nova\Http\Requests\NovaRequest $request) {
        return $this;
    }
    /**
     * @return $this
     */
    public function applyDependsOn(\Laravel\Nova\Http\Requests\NovaRequest $request) {
        return $this;
    }
    /**
     * @return array<string, mixed>|null
     */
    protected function getDependentsAttributes(\Laravel\Nova\Http\Requests\NovaRequest $request): ?array {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return array<string, mixed>
     */
    protected function serializeDependentField(\Laravel\Nova\Http\Requests\NovaRequest $request): array {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @no-named-arguments
     * @param  (callable(\Laravel\Nova\Http\Requests\NovaRequest):(array|\Stringable|string|callable))|array|\Stringable|string  ...$rules
     * @phpstan-param (callable(\Laravel\Nova\Http\Requests\NovaRequest):TValidationRules)|TValidationRules ...$rules
     * @return $this
     */
    public function rules($rules) {
        \func_get_args();
        return $this;
    }
    /**
     * @return array<array-key, array<int, mixed>>
     * @phpstan-return array<string, array<int, TFieldValidationRules>>
     */
    public function getRules(\Laravel\Nova\Http\Requests\NovaRequest $request): array {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return array<array-key, mixed>
     * @phpstan-return array<string, array<int, TFieldValidationRules>>
     */
    public function getCreationRules(\Laravel\Nova\Http\Requests\NovaRequest $request): array {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @no-named-arguments
     * @param  (callable(\Laravel\Nova\Http\Requests\NovaRequest):(array|\Stringable|string|callable))|array|\Stringable|string  ...$rules
     * @phpstan-param (callable(\Laravel\Nova\Http\Requests\NovaRequest):TValidationRules)|TValidationRules ...$rules
     * @return $this
     */
    public function creationRules($rules) {
        \func_get_args();
        return $this;
    }
    /**
     * @return array<array-key, array<int, mixed>>
     * @phpstan-return array<string, array<int, TFieldValidationRules>>
     */
    public function getUpdateRules(\Laravel\Nova\Http\Requests\NovaRequest $request): array {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @no-named-arguments
     * @param  (callable(\Laravel\Nova\Http\Requests\NovaRequest):(array|\Stringable|string|callable))|array|\Stringable|string  ...$rules
     * @phpstan-param (callable(\Laravel\Nova\Http\Requests\NovaRequest):TValidationRules)|TValidationRules ...$rules
     * @return $this
     */
    public function updateRules($rules) {
        \func_get_args();
        return $this;
    }
    public function getValidationAttribute(\Laravel\Nova\Http\Requests\NovaRequest $request): \Stringable|string {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return array<string, string>
     */
    public function getValidationAttributeNames(\Laravel\Nova\Http\Requests\NovaRequest $request): array {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    public function validationKey(): string {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  \Stringable|string|null  $text
     * @return $this
     */
    public function help($text) {
        return $this;
    }
    /**
     * @return \Stringable|string
     */
    public function getHelpText() {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  (callable(\Laravel\Nova\Http\Requests\NovaRequest):(bool))|bool  $callback
     * @return $this
     */
    public function immutable(callable|bool $callback = true) {
        return $this;
    }
    /**
     * @return $this
     */
    public function mutable() {
        return $this;
    }
    public function isWritable(\Laravel\Nova\Http\Requests\NovaRequest $request): bool {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    public function setValue(mixed $value): void {
    }
    /**
     * @param  (callable(mixed):(mixed))|null  $computedCallback
     * @return $this
     */
    public function computed(?callable $computedCallback = null) {
        return $this;
    }
    public function isComputed(): bool {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  (callable(\Laravel\Nova\Http\Requests\NovaRequest):(mixed))|mixed  $callback
     * @return $this
     */
    public function default(mixed $callback) {
        return $this;
    }
    public function resolveDefaultValue(\Laravel\Nova\Http\Requests\NovaRequest $request): mixed {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    public function resolveDefaultCallback(\Laravel\Nova\Http\Requests\NovaRequest $request): mixed {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    public function requestShouldResolveDefaultValue(\Laravel\Nova\Http\Requests\NovaRequest $request): bool {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  (callable(\Laravel\Nova\Http\Requests\NovaRequest):(bool))|bool  $callback
     * @return $this
     */
    public function readonly(callable|bool $callback = true) {
        return $this;
    }
    public function isReadonly(\Laravel\Nova\Http\Requests\NovaRequest $request): bool {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return array<string, mixed>
     */
    public function meta() {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  array<string, mixed>  $meta
     * @return $this
     */
    public function withMeta(array $meta) {
        return $this;
    }
    /**
     * @param  (callable(\Laravel\Nova\Http\Requests\NovaRequest):(bool))|bool  $callback
     * @return $this
     */
    public function showWhenPeeking(callable|bool $callback = true) {
        return $this;
    }
    public function isShownWhenPeeking(\Laravel\Nova\Http\Requests\NovaRequest $request): bool {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  (callable(\Laravel\Nova\Http\Requests\NovaRequest, \Illuminate\Database\Eloquent\Model|\Laravel\Nova\Support\Fluent|object|array):(bool))|bool  $callback
     * @return $this
     */
    public function showOnPreview(callable|bool $callback = true) {
        return $this;
    }
    /**
     * @return $this
     */
    public function onlyOnPreview() {
        return $this;
    }
    /**
     * @param  \Illuminate\Database\Eloquent\Model|\Laravel\Nova\Support\Fluent|object|array  $resource
     */
    public function isShownOnPreview(\Laravel\Nova\Http\Requests\NovaRequest $request, $resource): bool {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return $this
     */
    public function fullWidth() {
        return $this;
    }
    /**
     * @param  (callable($this): mixed)|null  $callback
     * @return ($callback is null ? \Illuminate\Support\HigherOrderTapProxy<$this> : $this)
     */
    public function tap($callback = null) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
}
