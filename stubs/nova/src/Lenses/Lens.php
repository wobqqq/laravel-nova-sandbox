<?php

// Test double of Laravel Nova: public signatures only, not Laravel Nova.

namespace Laravel\Nova\Lenses;

use ArrayAccess;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Contracts\Routing\UrlRoutable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Resources\ConditionallyLoadsAttributes;
use Illuminate\Http\Resources\DelegatesToResource;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use JsonSerializable;
use Laravel\Nova\AuthorizedToSee;
use Laravel\Nova\Fields\FieldCollection;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Http\Requests\LensRequest;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Makeable;
use Laravel\Nova\Nova;
use Laravel\Nova\ProxiesCanSeeToGate;
use Laravel\Nova\ResolvesActions;
use Laravel\Nova\ResolvesCards;
use Laravel\Nova\ResolvesFilters;
use Laravel\Nova\SupportsPolling;
use stdClass;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Attributes\PreserveKeys;
use Illuminate\Support\Stringable;
use ReflectionClass;
use Exception;
use Illuminate\Support\Traits\ForwardsCalls;
use Illuminate\Support\Traits\Macroable;
use BadMethodCallException;
use Error;
use ReflectionMethod;
use RuntimeException;
use Throwable;
use Laravel\Nova\Actions\ActionCollection;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\MorphToMany;
use function Orchestra\Sidekick\Eloquent\model_exists;
use Illuminate\Support\Collection;

abstract class Lens implements \ArrayAccess, \JsonSerializable, \Illuminate\Contracts\Routing\UrlRoutable
{
    /**
     * @var string
     */
    public $name = null;
    /**
     * @var \Illuminate\Database\Eloquent\Model|\stdClass
     */
    public $resource = null;
    /**
     * @var array
     */
    public static $search = [];
    /**
     * @var int|array<int, int>|null
     */
    public static $perPageOptions = null;
    /**
     * @var (\Closure(\Laravel\Nova\Http\Requests\NovaRequest|\Illuminate\Http\Request):(bool))|null
     */
    public $seeCallback = null;
    /**
     * @var array<class-string, bool>
     */
    protected static $cachedPreserveKeysAttributes = [];
    /**
     * @var array
     */
    protected static $macros = [];
    /**
     * @var bool
     */
    public static $polling = false;
    /**
     * @var int
     */
    public static $pollingInterval = 15;
    /**
     * @var bool
     */
    public static $showPollingToggle = false;
    /**
     * @return \Illuminate\Contracts\Database\Eloquent\Builder|\Illuminate\Contracts\Pagination\Paginator
     */
    abstract public static function query(\Laravel\Nova\Http\Requests\LensRequest $request, \Illuminate\Contracts\Database\Eloquent\Builder $query);
    /**
     * @return array<int, \Laravel\Nova\Fields\Field>
     */
    abstract public function fields(\Laravel\Nova\Http\Requests\NovaRequest $request);
    /**
     * @param  \Illuminate\Database\Eloquent\Model|null  $resource
     */
    public function __construct($resource = null) {
    }
    /**
     * @param  \Illuminate\Database\Eloquent\Model  $resource
     * @return $this
     */
    public function setResource($resource) {
        return $this;
    }
    /**
     * @return string
     */
    public function name() {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return string
     */
    public function uriKey() {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return array<int, \Laravel\Nova\Actions\Action>
     */
    public function actions(\Laravel\Nova\Http\Requests\NovaRequest $request) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return \Laravel\Nova\Fields\FieldCollection<int, \Laravel\Nova\Fields\Field>
     */
    public function resolveFields(\Laravel\Nova\Http\Requests\NovaRequest $request) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return \Laravel\Nova\Fields\FieldCollection<int, \Laravel\Nova\Fields\Field&\Laravel\Nova\Contracts\FilterableField>
     */
    public function filterableFields(\Laravel\Nova\Http\Requests\NovaRequest $request) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return \Laravel\Nova\Fields\FieldCollection
     */
    public function availableFields(\Laravel\Nova\Http\Requests\NovaRequest $request) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return bool
     */
    public static function searchable() {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return array
     */
    public static function searchableColumns() {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return array<int, int>|null
     */
    public static function perPageOptions() {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  \Laravel\Nova\Fields\FieldCollection<int, \Laravel\Nova\Fields\Field>  $fields
     * @return array
     */
    protected function serializeWithId(\Laravel\Nova\Fields\FieldCollection $fields) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return array<string, mixed>
     */
    public function jsonSerialize(): array {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return bool
     */
    public function authorizedToSee(\Illuminate\Http\Request $request) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  \Closure(\Laravel\Nova\Http\Requests\NovaRequest|\Illuminate\Http\Request):bool  $callback
     * @return $this
     */
    public function canSee(\Closure $callback) {
        return $this;
    }
    /**
     * @param  array  $data
     * @return array
     */
    protected function filter($data) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  array  $data
     * @param  int  $index
     * @param  array  $merge
     * @param  bool  $numericKeys
     * @return array
     */
    protected function mergeData($data, $index, $merge, $numericKeys) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  array  $data
     * @return array
     */
    protected function removeMissingValues($data) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  bool  $condition
     * @param  mixed  $value
     * @param  mixed  $default
     * @return \Illuminate\Http\Resources\MissingValue|mixed
     */
    protected function when($condition, $value, $default = new \Illuminate\Http\Resources\MissingValue()) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  bool  $condition
     * @param  mixed  $value
     * @param  mixed  $default
     * @return \Illuminate\Http\Resources\MissingValue|mixed
     */
    public function unless($condition, $value, $default = new \Illuminate\Http\Resources\MissingValue()) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  mixed  $value
     * @return \Illuminate\Http\Resources\MergeValue|mixed
     */
    protected function merge($value) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  bool  $condition
     * @param  mixed  $value
     * @param  mixed  $default
     * @return \Illuminate\Http\Resources\MergeValue|mixed
     */
    protected function mergeWhen($condition, $value, $default = new \Illuminate\Http\Resources\MissingValue()) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  bool  $condition
     * @param  mixed  $value
     * @param  mixed  $default
     * @return \Illuminate\Http\Resources\MergeValue|mixed
     */
    protected function mergeUnless($condition, $value, $default = new \Illuminate\Http\Resources\MissingValue()) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  array  $attributes
     * @return \Illuminate\Http\Resources\MergeValue
     */
    protected function attributes($attributes) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  string  $attribute
     * @param  mixed  $value
     * @param  mixed  $default
     * @return \Illuminate\Http\Resources\MissingValue|mixed
     */
    public function whenHas($attribute, $value = null, $default = new \Illuminate\Http\Resources\MissingValue()) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  mixed  $value
     * @param  mixed  $default
     * @return \Illuminate\Http\Resources\MissingValue|mixed
     */
    protected function whenNull($value, $default = new \Illuminate\Http\Resources\MissingValue()) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  mixed  $value
     * @param  mixed  $default
     * @return \Illuminate\Http\Resources\MissingValue|mixed
     */
    protected function whenNotNull($value, $default = new \Illuminate\Http\Resources\MissingValue()) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  string  $attribute
     * @param  mixed  $value
     * @param  mixed  $default
     * @return \Illuminate\Http\Resources\MissingValue|mixed
     */
    protected function whenAppended($attribute, $value = null, $default = new \Illuminate\Http\Resources\MissingValue()) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  string  $relationship
     * @param  mixed  $value
     * @param  mixed  $default
     * @return \Illuminate\Http\Resources\MissingValue|mixed
     */
    protected function whenLoaded($relationship, $value = null, $default = new \Illuminate\Http\Resources\MissingValue()) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  string  $relationship
     * @param  mixed  $value
     * @param  mixed  $default
     * @return \Illuminate\Http\Resources\MissingValue|mixed
     */
    public function whenCounted($relationship, $value = null, $default = new \Illuminate\Http\Resources\MissingValue()) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  string  $relationship
     * @param  string  $column
     * @param  string  $aggregate
     * @param  mixed  $value
     * @param  mixed  $default
     * @return \Illuminate\Http\Resources\MissingValue|mixed
     */
    public function whenAggregated($relationship, $column, $aggregate, $value = null, $default = new \Illuminate\Http\Resources\MissingValue()) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  string  $relationship
     * @param  mixed  $value
     * @param  mixed  $default
     * @return \Illuminate\Http\Resources\MissingValue|mixed
     */
    public function whenExistsLoaded($relationship, $value = null, $default = new \Illuminate\Http\Resources\MissingValue()) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  string  $table
     * @param  mixed  $value
     * @param  mixed  $default
     * @return \Illuminate\Http\Resources\MissingValue|mixed
     */
    protected function whenPivotLoaded($table, $value, $default = new \Illuminate\Http\Resources\MissingValue()) {
        \func_get_args();
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  string  $accessor
     * @param  string  $table
     * @param  mixed  $value
     * @param  mixed  $default
     * @return \Illuminate\Http\Resources\MissingValue|mixed
     */
    protected function whenPivotLoadedAs($accessor, $table, $value, $default = new \Illuminate\Http\Resources\MissingValue()) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  string  $table
     * @return bool
     */
    protected function hasPivotLoaded($table) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  string  $accessor
     * @param  string  $table
     * @return bool
     */
    protected function hasPivotLoadedAs($accessor, $table) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  mixed  $value
     * @param  callable  $callback
     * @param  mixed  $default
     * @return mixed
     */
    protected function transform($value, callable $callback, $default = new \Illuminate\Http\Resources\MissingValue()) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return mixed
     */
    public function getRouteKey() {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return string
     */
    public function getRouteKeyName() {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  mixed  $value
     * @param  string|null  $field
     * @return void
     * @throws \Exception
     */
    public function resolveRouteBinding($value, $field = null) {
    }
    /**
     * @param  string  $childType
     * @param  mixed  $value
     * @param  string|null  $field
     * @return void
     * @throws \Exception
     */
    public function resolveChildRouteBinding($childType, $value, $field = null) {
    }
    /**
     * @param  mixed  $offset
     * @return bool
     */
    public function offsetExists($offset): bool {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  mixed  $offset
     * @return mixed
     */
    public function offsetGet($offset): mixed {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  mixed  $offset
     * @param  mixed  $value
     * @return void
     */
    public function offsetSet($offset, $value): void {
    }
    /**
     * @param  mixed  $offset
     * @return void
     */
    public function offsetUnset($offset): void {
    }
    /**
     * @param  string  $key
     * @return bool
     */
    public function __isset($key) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  string  $key
     * @return void
     */
    public function __unset($key) {
    }
    /**
     * @param  string  $key
     * @return mixed
     */
    public function __get($key) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  string  $method
     * @param  array  $parameters
     * @return mixed
     */
    public function __call($method, $parameters) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  mixed  $object
     * @param  string  $method
     * @param  array  $parameters
     * @return mixed
     * @throws \BadMethodCallException
     */
    protected function forwardCallTo($object, $method, $parameters) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  mixed  $object
     * @param  string  $method
     * @param  array  $parameters
     * @return mixed
     * @throws \BadMethodCallException
     */
    protected function forwardDecoratedCallTo($object, $method, $parameters) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  string  $method
     * @return never
     * @throws \BadMethodCallException
     */
    protected static function throwBadMethodCallException($method) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  string  $name
     * @param  object|callable  $macro
     * @param-closure-this static  $macro
     * @return void
     */
    public static function macro($name, $macro) {
    }
    /**
     * @param  object  $mixin
     * @param  bool  $replace
     * @return void
     * @throws \ReflectionException
     */
    public static function mixin($mixin, $replace = true) {
    }
    /**
     * @param  string  $name
     * @return bool
     */
    public static function hasMacro($name) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return void
     */
    public static function flushMacros() {
    }
    /**
     * @param  string  $method
     * @param  array  $parameters
     * @return mixed
     * @throws \BadMethodCallException
     */
    public static function __callStatic($method, $parameters) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  string  $method
     * @param  array  $parameters
     * @return mixed
     * @throws \BadMethodCallException
     */
    public function macroCall($method, $parameters) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return static
     */
    public static function make(...$arguments) {
        return new static(...$arguments);
    }
    /**
     * @param  string  $ability
     * @param  array|mixed  $arguments
     * @return $this
     */
    public function canSeeWhen($ability, $arguments = []) {
        return $this;
    }
    /**
     * @return \Laravel\Nova\Actions\ActionCollection<int, \Laravel\Nova\Actions\Action>
     */
    public function availableActions(\Laravel\Nova\Http\Requests\NovaRequest $request): \Laravel\Nova\Actions\ActionCollection {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return \Laravel\Nova\Actions\ActionCollection<int, \Laravel\Nova\Actions\Action>
     */
    public function availableActionsOnIndex(\Laravel\Nova\Http\Requests\NovaRequest $request): \Laravel\Nova\Actions\ActionCollection {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return \Laravel\Nova\Actions\ActionCollection<int, \Laravel\Nova\Actions\Action>
     */
    public function availableActionsOnDetail(\Laravel\Nova\Http\Requests\NovaRequest $request): \Laravel\Nova\Actions\ActionCollection {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return \Laravel\Nova\Actions\ActionCollection<int, \Laravel\Nova\Actions\Action>
     */
    public function availableActionsOnTableRow(\Laravel\Nova\Http\Requests\NovaRequest $request): \Laravel\Nova\Actions\ActionCollection {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return \Laravel\Nova\Actions\ActionCollection<int, \Laravel\Nova\Actions\Action>
     */
    public function resolveActions(\Laravel\Nova\Http\Requests\NovaRequest $request): \Laravel\Nova\Actions\ActionCollection {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return \Laravel\Nova\Actions\ActionCollection<int, \Laravel\Nova\Actions\Action>
     */
    public function availablePivotActions(\Laravel\Nova\Http\Requests\NovaRequest $request): \Laravel\Nova\Actions\ActionCollection {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return \Laravel\Nova\Actions\ActionCollection<int, \Laravel\Nova\Actions\Action>
     */
    public function resolvePivotActions(\Laravel\Nova\Http\Requests\NovaRequest $request): \Laravel\Nova\Actions\ActionCollection {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return array<int, \Laravel\Nova\Actions\Action>
     */
    protected function getPivotActions(\Laravel\Nova\Http\Requests\NovaRequest $request): array {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return array<int, \Laravel\Nova\Actions\Action>
     */
    public static function defaultsWith(array $actions): array {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return array<int, \Laravel\Nova\Actions\Action>
     */
    public static function defaultActions() {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return \Illuminate\Support\Collection<int, \Laravel\Nova\Metrics\Metric|\Laravel\Nova\Card>
     */
    public function availableCards(\Laravel\Nova\Http\Requests\NovaRequest $request): \Illuminate\Support\Collection {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return \Illuminate\Support\Collection<int, \Laravel\Nova\Metrics\Metric|\Laravel\Nova\Card>
     */
    public function availableCardsForDetail(\Laravel\Nova\Http\Requests\NovaRequest $request): \Illuminate\Support\Collection {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return \Illuminate\Support\Collection<int, \Laravel\Nova\Metrics\Metric|\Laravel\Nova\Card>
     */
    public function resolveCards(\Laravel\Nova\Http\Requests\NovaRequest $request): \Illuminate\Support\Collection {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return array
     */
    public function cards(\Laravel\Nova\Http\Requests\NovaRequest $request) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return \Illuminate\Support\Collection<int, \Laravel\Nova\Filters\Filter>
     */
    public function availableFilters(\Laravel\Nova\Http\Requests\NovaRequest $request): \Illuminate\Support\Collection {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return \Illuminate\Support\Collection<int, \Laravel\Nova\Filters\Filter>
     */
    public function resolveFilters(\Laravel\Nova\Http\Requests\NovaRequest $request): \Illuminate\Support\Collection {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    public function resolveFiltersFromFields(\Laravel\Nova\Http\Requests\NovaRequest $request): \Illuminate\Support\Collection {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return array
     */
    public function filters(\Laravel\Nova\Http\Requests\NovaRequest $request) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
}
