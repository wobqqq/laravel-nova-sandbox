<?php

// Test double of Laravel Nova: public signatures only, not Laravel Nova.

namespace Laravel\Nova;

use ArrayAccess;
use Illuminate\Contracts\Routing\UrlRoutable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\ConditionallyLoadsAttributes;
use Illuminate\Http\Resources\DelegatesToResource;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use InvalidArgumentException;
use JsonSerializable;
use Laravel\Nova\Fields\HasAttachments;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Menu\MenuItem;
use Laravel\Scout\Searchable;
use function Orchestra\Sidekick\Eloquent\model_exists;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Gate;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Actions\DestructiveAction;
use Laravel\Nova\Contracts\ImpersonatesUsers;
use Illuminate\Http\Resources\Attributes\PreserveKeys;
use Illuminate\Support\Stringable;
use ReflectionClass;
use Exception;
use Illuminate\Support\Traits\ForwardsCalls;
use Illuminate\Support\Traits\Macroable;
use BadMethodCallException;
use Error;
use Closure;
use ReflectionMethod;
use RuntimeException;
use Throwable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Laravel\Nova\Query\Search;
use Laravel\Nova\Query\Search\PrimaryKey;
use Laravel\Scout\Builder as ScoutBuilder;
use Illuminate\Contracts\Validation\Validator as ValidatorContract;
use Illuminate\Support\Facades\Validator;
use Laravel\Nova\Contracts\PivotableField;
use Laravel\Nova\Actions\ActionCollection;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\MorphToMany;
use Illuminate\Database\Eloquent\Relations\Relation;
use Laravel\Nova\Actions\Actionable;
use Laravel\Nova\Contracts\BehavesAsPanel;
use Laravel\Nova\Contracts\Cover;
use Laravel\Nova\Contracts\Deletable;
use Laravel\Nova\Contracts\Downloadable;
use Laravel\Nova\Contracts\ListableField;
use Laravel\Nova\Contracts\RelatableField;
use Laravel\Nova\Contracts\Resolvable;
use Laravel\Nova\Fields\Field;
use Laravel\Nova\Fields\FieldCollection;
use Laravel\Nova\Fields\MorphMany;
use Laravel\Nova\Fields\MorphTo;
use Laravel\Nova\Fields\Unfillable;
use Laravel\Nova\Tabs\TabsGroup;
use ReflectionNamedType;

/**
 * @template TModel of \Illuminate\Database\Eloquent\Model
 * @phpstan-type TFields \Illuminate\Http\Resources\MissingValue|\Laravel\Nova\Fields\Field|\Laravel\Nova\Panel|\Laravel\Nova\ResourceToolElement
 * @mixin TModel
 * @method static static make(\Illuminate\Database\Eloquent\Model|null $resource)
 * @method mixed getKey()
 */
abstract class Resource implements \ArrayAccess, \JsonSerializable, \Illuminate\Contracts\Routing\UrlRoutable
{
    /**
     * @var string
     */
    public const DEFAULT_PIVOT_NAME = 'Pivot';
    /**
     * @var string
     */
    public static $tableStyle = 'default';
    /**
     * @var bool
     */
    public static $showColumnBorders = false;
    /**
     * @var TModel|null
     */
    public $resource = null;
    /**
     * @var \Stringable|string
     */
    public static $group = 'Other';
    /**
     * @var string
     */
    public static $title = 'id';
    /**
     * @var array
     */
    public static $with = [];
    /**
     * @var array
     */
    public static $search = [];
    /**
     * @var bool
     */
    public static $displayInNavigation = true;
    /**
     * @var bool
     */
    public static $globallySearchable = true;
    /**
     * @var int
     */
    public static $globalSearchResults = 5;
    /**
     * @var int|null
     */
    public static $relatableSearchResults = null;
    /**
     * @var int
     */
    public static $scoutSearchResults = 200;
    /**
     * @var string
     */
    public static $globalSearchLink = 'detail';
    /**
     * @var bool
     */
    public static $searchable = true;
    /**
     * @var int|array<int, int>|null
     */
    public static $perPageOptions = [25, 50, 100];
    /**
     * @var int
     */
    public static $perPageViaRelationship = 5;
    /**
     * @var int|array<int, int>|null
     */
    public static $perPageViaRelationshipOptions = null;
    /**
     * @var array<class-string<\Illuminate\Database\Eloquent\Model>, bool>
     */
    public static $softDeletes = [];
    /**
     * @var bool
     */
    public static $trafficCop = true;
    /**
     * @var int
     */
    public static $maxPrimaryKeySize = 9223372036854775807;
    /**
     * @var float
     */
    public static $debounce = 0.5;
    /**
     * @var string
     */
    public static $clickAction = 'detail';
    /**
     * @var array
     */
    public static $afterCallbacks = [];
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
     * @param  TModel|null  $resource
     */
    public function __construct($resource = null) {
    }
    /**
     * @return static<TModel>
     */
    public static function newResource() {
        return new static();
    }
    /**
     * @return TModel
     */
    public static function newModel() {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return array<string, mixed>
     */
    public static function defaultAttributes() {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return array
     */
    abstract public function fields(\Laravel\Nova\Http\Requests\NovaRequest $request);
    /**
     * @return TModel|null
     */
    public function model() {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return static
     * @throws \InvalidArgumentException
     */
    public function replicate() {
        return $this;
    }
    /**
     * @return \Stringable|string
     */
    public static function group() {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return bool
     */
    public static function availableForNavigation(\Illuminate\Http\Request $request) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return bool
     */
    public static function softDeletes() {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return bool
     */
    public static function searchable() {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return \Stringable|string
     */
    public function globalSearchLink(\Laravel\Nova\Http\Requests\NovaRequest $request) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return bool
     */
    public static function usesScout() {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return array
     */
    public static function searchableColumns() {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return \Stringable|string
     */
    public static function label() {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return \Stringable|string
     */
    public static function singularLabel() {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return \Stringable|string
     */
    public function title() {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return \Stringable|string|null
     */
    public function subtitle() {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return \Stringable|string|null
     */
    public static function createButtonLabel() {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return \Stringable|string|null
     */
    public static function updateButtonLabel() {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return string
     */
    public static function uriKey() {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return array<string, mixed>
     */
    public static function additionalInformation(\Illuminate\Http\Request $request) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return array<int, int>
     */
    public static function perPageOptions() {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return array<int, int>
     */
    public static function perPageViaRelationshipOptions() {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return bool
     */
    public static function trafficCop(\Illuminate\Http\Request $request) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  \Illuminate\Support\Collection<int, \Laravel\Nova\Fields\Field>  $fields
     * @return array<string, mixed>
     */
    public function serializeForIndex(\Laravel\Nova\Http\Requests\NovaRequest $request, $fields = null) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  \Laravel\Nova\Resource  $resource
     * @return array<string, mixed>
     */
    public function serializeForDetail(\Laravel\Nova\Http\Requests\NovaRequest $request, \Laravel\Nova\Resource $resource) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return array<string, mixed>
     */
    public function serializeForPreview(\Laravel\Nova\Http\Requests\NovaRequest $request) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return array<string, mixed>
     */
    public function serializeForPeeking(\Laravel\Nova\Http\Requests\NovaRequest $request) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return bool
     */
    protected function authorizedToUpdateForSerialization(\Laravel\Nova\Http\Requests\NovaRequest $request) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return bool
     */
    protected function authorizedToDeleteForSerialization(\Laravel\Nova\Http\Requests\NovaRequest $request) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return bool
     */
    public function isSoftDeleted() {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return array<string, mixed>
     */
    public function jsonSerialize(): array {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  \Illuminate\Support\Collection<int, \Laravel\Nova\Fields\Field>  $fields
     * @return array
     */
    protected function serializeWithId(\Illuminate\Support\Collection $fields) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  \Laravel\Nova\Resource  $resource
     * @return \Laravel\Nova\URL|string
     */
    public static function redirectAfterCreate(\Laravel\Nova\Http\Requests\NovaRequest $request, \Laravel\Nova\Resource $resource) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  \Laravel\Nova\Resource  $resource
     * @return \Laravel\Nova\URL|string
     */
    public static function redirectAfterUpdate(\Laravel\Nova\Http\Requests\NovaRequest $request, \Laravel\Nova\Resource $resource) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return \Laravel\Nova\URL|string|null
     */
    public static function redirectAfterDelete(\Laravel\Nova\Http\Requests\NovaRequest $request) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return int
     */
    public static function maxPrimaryKeySize() {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return bool
     */
    public static function showColumnBorders() {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return string
     */
    public static function tableStyle() {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return string
     */
    public static function clickAction() {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return \Laravel\Nova\Menu\MenuItem
     */
    public function menu(\Illuminate\Http\Request $request) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return bool
     */
    public static function authorizable() {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return \Illuminate\Auth\Access\Gate|null
     */
    public static function authorizationGate() {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return void
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function authorizeToViewAny(\Illuminate\Http\Request $request) {
    }
    /**
     * @return bool
     */
    public static function authorizedToViewAny(\Illuminate\Http\Request $request) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return void
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function authorizeToView(\Illuminate\Http\Request $request) {
    }
    /**
     * @return bool
     */
    public function authorizedToView(\Illuminate\Http\Request $request) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return void
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public static function authorizeToCreate(\Illuminate\Http\Request $request) {
    }
    /**
     * @return bool
     */
    public static function authorizedToCreate(\Illuminate\Http\Request $request) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return void
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function authorizeToUpdate(\Illuminate\Http\Request $request) {
    }
    /**
     * @return bool
     */
    public function authorizedToUpdate(\Illuminate\Http\Request $request) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return void
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function authorizeToReplicate(\Illuminate\Http\Request $request) {
    }
    /**
     * @return bool
     */
    public function authorizedToReplicate(\Illuminate\Http\Request $request) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return void
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function authorizeToDelete(\Illuminate\Http\Request $request) {
    }
    /**
     * @return bool
     */
    public function authorizedToDelete(\Illuminate\Http\Request $request) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return bool
     */
    public function authorizedToRestore(\Illuminate\Http\Request $request) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return bool
     */
    public function authorizedToForceDelete(\Illuminate\Http\Request $request) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  \Illuminate\Database\Eloquent\Model|string  $model
     * @return bool
     */
    public function authorizedToAdd(\Laravel\Nova\Http\Requests\NovaRequest $request, $model) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  \Illuminate\Database\Eloquent\Model|string  $model
     * @return bool
     */
    public function authorizedToAttachAny(\Laravel\Nova\Http\Requests\NovaRequest $request, $model) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  \Illuminate\Database\Eloquent\Model|string  $model
     * @return bool
     */
    public function authorizedToAttach(\Laravel\Nova\Http\Requests\NovaRequest $request, $model) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  \Illuminate\Database\Eloquent\Model|string  $model
     * @param  string  $relationship
     * @return bool
     */
    public function authorizedToDetach(\Laravel\Nova\Http\Requests\NovaRequest $request, $model, $relationship) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return bool
     */
    public function authorizedToRunAction(\Laravel\Nova\Http\Requests\NovaRequest $request, \Laravel\Nova\Actions\Action $action) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return bool
     */
    public function authorizedToRunDestructiveAction(\Laravel\Nova\Http\Requests\NovaRequest $request, \Laravel\Nova\Actions\DestructiveAction $action) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return bool
     */
    public function authorizedToImpersonate(\Laravel\Nova\Http\Requests\NovaRequest $request) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function authorizeTo(\Illuminate\Http\Request $request, string $ability): void {
    }
    public function authorizedTo(\Illuminate\Http\Request $request, string $ability): bool {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
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
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return array{\Illuminate\Database\Eloquent\Model, array<int, callable>}
     */
    public static function fill(\Laravel\Nova\Http\Requests\NovaRequest $request, $model): array {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return array{\Illuminate\Database\Eloquent\Model, array<int, callable>}
     */
    public static function fillForUpdate(\Laravel\Nova\Http\Requests\NovaRequest $request, $model): array {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @param  \Illuminate\Database\Eloquent\Relations\Pivot  $pivot
     * @return array{\Illuminate\Database\Eloquent\Relations\Pivot, array<int, callable>}
     */
    public static function fillPivot(\Laravel\Nova\Http\Requests\NovaRequest $request, $model, $pivot): array {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @param  \Illuminate\Database\Eloquent\Relations\Pivot  $pivot
     * @return array{\Illuminate\Database\Eloquent\Relations\Pivot, array<int, callable>}
     */
    public static function fillPivotForUpdate(\Laravel\Nova\Http\Requests\NovaRequest $request, $model, $pivot): array {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @template TModelOrPivot of \Illuminate\Database\Eloquent\Relations\Pivot|\Illuminate\Database\Eloquent\Model
     * @param  TModelOrPivot  $model
     * @param  \Illuminate\Support\Collection<int, \Laravel\Nova\Fields\Field>  $fields
     * @return array{TModelOrPivot, array<int, callable>}
     */
    protected static function fillFields(\Laravel\Nova\Http\Requests\NovaRequest $request, $model, \Illuminate\Support\Collection $fields): array {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return void
     */
    public static function beforeCreate(\Laravel\Nova\Http\Requests\NovaRequest $request, \Illuminate\Database\Eloquent\Model $model) {
    }
    /**
     * @return void
     */
    public static function afterCreate(\Laravel\Nova\Http\Requests\NovaRequest $request, \Illuminate\Database\Eloquent\Model $model) {
    }
    /**
     * @return void
     */
    public static function beforeUpdate(\Laravel\Nova\Http\Requests\NovaRequest $request, \Illuminate\Database\Eloquent\Model $model) {
    }
    /**
     * @return void
     */
    public static function afterUpdate(\Laravel\Nova\Http\Requests\NovaRequest $request, \Illuminate\Database\Eloquent\Model $model) {
    }
    /**
     * @return void
     */
    public static function beforeDelete(\Laravel\Nova\Http\Requests\NovaRequest $request, \Illuminate\Database\Eloquent\Model $model) {
    }
    /**
     * @return void
     */
    public static function afterDelete(\Laravel\Nova\Http\Requests\NovaRequest $request, \Illuminate\Database\Eloquent\Model $model) {
    }
    /**
     * @return void
     */
    public static function beforeForceDelete(\Laravel\Nova\Http\Requests\NovaRequest $request, \Illuminate\Database\Eloquent\Model $model) {
    }
    /**
     * @return void
     */
    public static function afterForceDelete(\Laravel\Nova\Http\Requests\NovaRequest $request, \Illuminate\Database\Eloquent\Model $model) {
    }
    /**
     * @return void
     */
    public static function beforeRestore(\Laravel\Nova\Http\Requests\NovaRequest $request, \Illuminate\Database\Eloquent\Model $model) {
    }
    /**
     * @return void
     */
    public static function afterRestore(\Laravel\Nova\Http\Requests\NovaRequest $request, \Illuminate\Database\Eloquent\Model $model) {
    }
    /**
     * @return static
     */
    public static function make(...$arguments) {
        return new static(...$arguments);
    }
    /**
     * @param  array<int, \Laravel\Nova\Query\ApplyFilter>  $filters
     * @param  array<string, string>  $orderings
     * @return \Illuminate\Contracts\Database\Eloquent\Builder
     */
    public static function buildIndexQuery(\Laravel\Nova\Http\Requests\NovaRequest $request, \Illuminate\Contracts\Database\Eloquent\Builder $query, ?string $search = null, array $filters = [], array $orderings = [], \Laravel\Nova\TrashedStatus $withTrashed = \Laravel\Nova\TrashedStatus::DEFAULT) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return \Illuminate\Contracts\Database\Eloquent\Builder
     */
    protected static function initializeQuery(\Laravel\Nova\Http\Requests\NovaRequest $request, \Illuminate\Contracts\Database\Eloquent\Builder $query, string $search, \Laravel\Nova\TrashedStatus $withTrashed) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    protected static function applySearch(\Illuminate\Contracts\Database\Eloquent\Builder $query, string $search): \Illuminate\Contracts\Database\Eloquent\Builder {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    protected static function initializeSearch(\Illuminate\Contracts\Database\Eloquent\Builder $query, string $search, array $searchColumns): \Illuminate\Contracts\Database\Eloquent\Builder {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    protected static function initializeQueryUsingScout(\Laravel\Nova\Http\Requests\NovaRequest $request, \Illuminate\Contracts\Database\Eloquent\Builder $query, string $search, \Laravel\Nova\TrashedStatus $withTrashed): \Illuminate\Contracts\Database\Eloquent\Builder {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    public static function buildIndexQueryUsingScout(\Laravel\Nova\Http\Requests\NovaRequest $request, ?string $search = null, \Laravel\Nova\TrashedStatus $withTrashed = \Laravel\Nova\TrashedStatus::DEFAULT): \Laravel\Scout\Builder {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  \Illuminate\Contracts\Database\Eloquent\Builder|\Laravel\Scout\Builder  $query
     * @return \Illuminate\Contracts\Database\Eloquent\Builder|\Laravel\Scout\Builder
     */
    protected static function applySoftDeleteConstraint($query, \Laravel\Nova\TrashedStatus $withTrashed) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  array<int, \Laravel\Nova\Query\ApplyFilter>  $filters
     */
    protected static function applyFilters(\Laravel\Nova\Http\Requests\NovaRequest $request, \Illuminate\Contracts\Database\Eloquent\Builder $query, array $filters): \Illuminate\Contracts\Database\Eloquent\Builder {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  array<string, string>  $orderings
     */
    protected static function applyOrderings(\Illuminate\Contracts\Database\Eloquent\Builder $query, array $orderings): \Illuminate\Contracts\Database\Eloquent\Builder {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return \Illuminate\Contracts\Database\Eloquent\Builder
     */
    public static function defaultOrderings(\Illuminate\Contracts\Database\Eloquent\Builder $query) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return \Illuminate\Contracts\Database\Eloquent\Builder
     */
    public static function indexQuery(\Laravel\Nova\Http\Requests\NovaRequest $request, \Illuminate\Contracts\Database\Eloquent\Builder $query) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return \Laravel\Scout\Builder
     */
    public static function scoutQuery(\Laravel\Nova\Http\Requests\NovaRequest $request, \Laravel\Scout\Builder $query) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return \Illuminate\Contracts\Database\Eloquent\Builder
     */
    public static function detailQuery(\Laravel\Nova\Http\Requests\NovaRequest $request, \Illuminate\Contracts\Database\Eloquent\Builder $query) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return \Illuminate\Contracts\Database\Eloquent\Builder
     */
    public static function editQuery(\Laravel\Nova\Http\Requests\NovaRequest $request, \Illuminate\Contracts\Database\Eloquent\Builder $query) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return \Illuminate\Contracts\Database\Eloquent\Builder
     */
    public static function replicateQuery(\Laravel\Nova\Http\Requests\NovaRequest $request, \Illuminate\Contracts\Database\Eloquent\Builder $query) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return \Illuminate\Contracts\Database\Eloquent\Builder
     */
    public static function relatableQuery(\Laravel\Nova\Http\Requests\NovaRequest $request, \Illuminate\Contracts\Database\Eloquent\Builder $query) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    public static function validateForCreation(\Laravel\Nova\Http\Requests\NovaRequest $request): void {
    }
    public static function validatorForCreation(\Laravel\Nova\Http\Requests\NovaRequest $request): \Illuminate\Contracts\Validation\Validator {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return array<array-key, mixed>
     * @phpstan-return array<array-key, TFieldValidationRules>
     */
    public static function rulesForCreation(\Laravel\Nova\Http\Requests\NovaRequest $request): array {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return array<array-key, mixed>
     * @phpstan-return array<array-key, TFieldValidationRules>
     */
    public static function creationRulesFor(\Laravel\Nova\Http\Requests\NovaRequest $request, string $field): array {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    public static function validateForUpdate(\Laravel\Nova\Http\Requests\NovaRequest $request, ?\Laravel\Nova\Resource $resource = null): void {
    }
    /**
     * @param  \Laravel\Nova\Resource|null  $resource
     */
    public static function validatorForUpdate(\Laravel\Nova\Http\Requests\NovaRequest $request, ?\Laravel\Nova\Resource $resource = null): \Illuminate\Contracts\Validation\Validator {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  \Laravel\Nova\Resource|null  $resource
     * @return array<array-key, mixed>
     * @phpstan-return array<array-key, TFieldValidationRules>
     */
    public static function rulesForUpdate(\Laravel\Nova\Http\Requests\NovaRequest $request, ?\Laravel\Nova\Resource $resource = null): array {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return array<array-key, mixed>
     * @phpstan-return array<array-key, TFieldValidationRules>
     */
    public static function updateRulesFor(\Laravel\Nova\Http\Requests\NovaRequest $request, string $field): array {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    public static function validateForAttachment(\Laravel\Nova\Http\Requests\NovaRequest $request): void {
    }
    public static function validatorForAttachment(\Laravel\Nova\Http\Requests\NovaRequest $request): \Illuminate\Contracts\Validation\Validator {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return array<array-key, mixed>
     * @phpstan-return array<array-key, TFieldValidationRules>
     */
    public static function rulesForAttachment(\Laravel\Nova\Http\Requests\NovaRequest $request): array {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    public static function validateForAttachmentUpdate(\Laravel\Nova\Http\Requests\NovaRequest $request): void {
    }
    public static function validatorForAttachmentUpdate(\Laravel\Nova\Http\Requests\NovaRequest $request): \Illuminate\Contracts\Validation\Validator {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return array<array-key, mixed>
     * @phpstan-return array<array-key, TFieldValidationRules>
     */
    public static function rulesForAttachmentUpdate(\Laravel\Nova\Http\Requests\NovaRequest $request): array {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return array<array-key, mixed>
     * @phpstan-return array<array-key, TFieldValidationRules>
     */
    protected static function formatRules(\Laravel\Nova\Http\Requests\NovaRequest $request, array $rules): array {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    public static function validationAttributeFor(\Laravel\Nova\Http\Requests\NovaRequest $request, string $resourceName): \Stringable|string {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    public static function validationAttachableAttributeFor(\Laravel\Nova\Http\Requests\NovaRequest $request, string $resourceName): \Stringable|string {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  \Laravel\Nova\Resource|null  $resource
     * @return \Illuminate\Support\Collection<string, string>
     */
    private static function attributeNamesForFields(\Laravel\Nova\Http\Requests\NovaRequest $request, ?\Laravel\Nova\Resource $resource = null): \Illuminate\Support\Collection {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return void
     */
    protected static function afterValidation(\Laravel\Nova\Http\Requests\NovaRequest $request, \Illuminate\Contracts\Validation\Validator $validator) {
    }
    /**
     * @return void
     */
    protected static function afterCreationValidation(\Laravel\Nova\Http\Requests\NovaRequest $request, \Illuminate\Contracts\Validation\Validator $validator) {
    }
    /**
     * @return void
     */
    protected static function afterUpdateValidation(\Laravel\Nova\Http\Requests\NovaRequest $request, \Illuminate\Contracts\Validation\Validator $validator) {
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
     * @return array
     */
    public function actions(\Laravel\Nova\Http\Requests\NovaRequest $request) {
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
     * @return \Laravel\Nova\Fields\FieldCollection<int, \Laravel\Nova\Fields\Field>
     */
    public function indexFields(\Laravel\Nova\Http\Requests\NovaRequest $request): \Laravel\Nova\Fields\FieldCollection {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return \Laravel\Nova\Fields\FieldCollection<int, \Laravel\Nova\Fields\Field>
     */
    public function detailFields(\Laravel\Nova\Http\Requests\NovaRequest $request): \Laravel\Nova\Fields\FieldCollection {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return \Laravel\Nova\Fields\FieldCollection<int, TFields>
     */
    protected function previewFieldsCollection(\Laravel\Nova\Http\Requests\NovaRequest $request): \Laravel\Nova\Fields\FieldCollection {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return \Laravel\Nova\Fields\FieldCollection<int, TFields>
     */
    public function previewFields(\Laravel\Nova\Http\Requests\NovaRequest $request): \Laravel\Nova\Fields\FieldCollection {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    public function previewFieldsCount(\Laravel\Nova\Http\Requests\NovaRequest $request): int {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return \Laravel\Nova\Fields\FieldCollection<int, \Laravel\Nova\Fields\Field>
     */
    protected function peekableFieldsCollection(\Laravel\Nova\Http\Requests\NovaRequest $request): \Laravel\Nova\Fields\FieldCollection {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return \Laravel\Nova\Fields\FieldCollection<int, \Laravel\Nova\Fields\Field>
     */
    public function peekableFields(\Laravel\Nova\Http\Requests\NovaRequest $request): \Laravel\Nova\Fields\FieldCollection {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    public function peekableFieldsCount(\Laravel\Nova\Http\Requests\NovaRequest $request): int {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return \Laravel\Nova\Fields\FieldCollection<int, \Laravel\Nova\Fields\Field&\Laravel\Nova\Contracts\Deletable>
     */
    public function deletableFields(\Laravel\Nova\Http\Requests\NovaRequest $request): \Laravel\Nova\Fields\FieldCollection {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return \Laravel\Nova\Fields\FieldCollection<int, \Laravel\Nova\Fields\Field&\Laravel\Nova\Contracts\Downloadable>
     */
    public function downloadableFields(\Laravel\Nova\Http\Requests\NovaRequest $request): \Laravel\Nova\Fields\FieldCollection {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return \Laravel\Nova\Fields\FieldCollection<int, \Laravel\Nova\Fields\Field&\Laravel\Nova\Contracts\FilterableField>
     */
    public function filterableFields(\Laravel\Nova\Http\Requests\NovaRequest $request): \Laravel\Nova\Fields\FieldCollection {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    public function relatableField(\Laravel\Nova\Http\Requests\NovaRequest $request, string $attribute): ?\Laravel\Nova\Fields\Field {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    public function hasRelatableField(\Laravel\Nova\Http\Requests\NovaRequest $request, string $attribute): bool {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    public function hasRelatableFieldOrRelationship(\Laravel\Nova\Http\Requests\NovaRequest $request, string $attribute): bool {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return \Closure(mixed):(bool)
     */
    protected function shouldAddActionsField(\Laravel\Nova\Http\Requests\NovaRequest $request): \Closure {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    protected function actionEventsField(): \Laravel\Nova\Fields\MorphMany {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  \Laravel\Nova\Resource  $resource
     * @return \Laravel\Nova\Fields\FieldCollection<int, \Laravel\Nova\Fields\Field>
     */
    public function detailFieldsWithinPanels(\Laravel\Nova\Http\Requests\NovaRequest $request, \Laravel\Nova\Resource $resource): \Laravel\Nova\Fields\FieldCollection {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return \Laravel\Nova\Fields\FieldCollection<int, \Laravel\Nova\Fields\Field>
     */
    public function creationFields(\Laravel\Nova\Http\Requests\NovaRequest $request): \Laravel\Nova\Fields\FieldCollection {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return \Laravel\Nova\Fields\FieldCollection<int, \Laravel\Nova\Fields\Field>
     */
    public function creationFieldsWithoutReadonly(\Laravel\Nova\Http\Requests\NovaRequest $request): \Laravel\Nova\Fields\FieldCollection {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return \Laravel\Nova\Fields\FieldCollection<int, \Laravel\Nova\Fields\Field>
     */
    public function creationFieldsWithinPanels(\Laravel\Nova\Http\Requests\NovaRequest $request): \Laravel\Nova\Fields\FieldCollection {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return \Laravel\Nova\Fields\FieldCollection<int, \Laravel\Nova\Fields\Field>
     */
    public function creationPivotFields(\Laravel\Nova\Http\Requests\NovaRequest $request, string $relatedResource): \Laravel\Nova\Fields\FieldCollection {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return \Laravel\Nova\Fields\FieldCollection<int, \Laravel\Nova\Fields\Field>
     */
    public function updateFields(\Laravel\Nova\Http\Requests\NovaRequest $request): \Laravel\Nova\Fields\FieldCollection {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return \Laravel\Nova\Fields\FieldCollection<int, \Laravel\Nova\Fields\Field>
     */
    public function updateFieldsWithoutReadonly(\Laravel\Nova\Http\Requests\NovaRequest $request): \Laravel\Nova\Fields\FieldCollection {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  \Laravel\Nova\Resource|null  $resource
     * @return \Laravel\Nova\Fields\FieldCollection<int, \Laravel\Nova\Fields\Field>
     */
    public function updateFieldsWithinPanels(\Laravel\Nova\Http\Requests\NovaRequest $request, ?\Laravel\Nova\Resource $resource = null): \Laravel\Nova\Fields\FieldCollection {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  string  $relatedResource
     * @return \Laravel\Nova\Fields\FieldCollection<int, \Laravel\Nova\Fields\Field>
     */
    public function updatePivotFields(\Laravel\Nova\Http\Requests\NovaRequest $request, $relatedResource): \Laravel\Nova\Fields\FieldCollection {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    protected function removeNonPreviewFields(\Laravel\Nova\Http\Requests\NovaRequest $request, \Laravel\Nova\Fields\FieldCollection $fields): \Laravel\Nova\Fields\FieldCollection {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  (\Closure(\Laravel\Nova\Fields\FieldCollection):(\Laravel\Nova\Fields\FieldCollection))|null  $filter
     * @return \Laravel\Nova\Fields\FieldCollection<int, \Laravel\Nova\Fields\Field>
     */
    protected function resolveFields(\Laravel\Nova\Http\Requests\NovaRequest $request, ?\Closure $filter = null): \Laravel\Nova\Fields\FieldCollection {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    public function resolveFieldForAttribute(\Laravel\Nova\Http\Requests\NovaRequest $request, string $attribute): \Laravel\Nova\Fields\Field {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    public function resolveInverseFieldsForAttribute(\Laravel\Nova\Http\Requests\NovaRequest $request, string $attribute, ?string $morphType = null): \Laravel\Nova\Fields\FieldCollection {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    public function resolveAvatarField(\Laravel\Nova\Http\Requests\NovaRequest $request): ?\Laravel\Nova\Contracts\Cover {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    public function resolveAvatarUrl(\Laravel\Nova\Http\Requests\NovaRequest $request): ?string {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    public function resolveIfAvatarShouldBeRounded(\Laravel\Nova\Http\Requests\NovaRequest $request): bool {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  \Laravel\Nova\Fields\FieldCollection<int, \Laravel\Nova\Fields\Field>|null  $fields
     * @return array<int, \Laravel\Nova\Panel>
     */
    public function availablePanelsForCreate(\Laravel\Nova\Http\Requests\NovaRequest $request, ?\Laravel\Nova\Fields\FieldCollection $fields = null): array {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  \Laravel\Nova\Resource  $resource
     * @param  \Laravel\Nova\Fields\FieldCollection<int, \Laravel\Nova\Fields\Field>|null  $fields
     * @return array<int, \Laravel\Nova\Panel>
     */
    public function availablePanelsForUpdate(\Laravel\Nova\Http\Requests\NovaRequest $request, ?\Laravel\Nova\Resource $resource = null, ?\Laravel\Nova\Fields\FieldCollection $fields = null): array {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  \Laravel\Nova\Resource  $resource
     * @param  \Laravel\Nova\Fields\FieldCollection<int, \Laravel\Nova\Fields\Field>  $fields
     * @return array<int, \Laravel\Nova\Panel>
     */
    public function availablePanelsForDetail(\Laravel\Nova\Http\Requests\NovaRequest $request, \Laravel\Nova\Resource $resource, \Laravel\Nova\Fields\FieldCollection $fields): array {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return \Laravel\Nova\Fields\FieldCollection<int, \Laravel\Nova\Fields\Field>
     */
    public function availableFields(\Laravel\Nova\Http\Requests\NovaRequest $request): \Laravel\Nova\Fields\FieldCollection {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return \Laravel\Nova\Fields\FieldCollection<int, \Laravel\Nova\Fields\Field>
     */
    public function availableFieldsOnIndexOrDetail(\Laravel\Nova\Http\Requests\NovaRequest $request): \Laravel\Nova\Fields\FieldCollection {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return \Laravel\Nova\Fields\FieldCollection<int, \Laravel\Nova\Fields\Field>
     */
    public function buildAvailableFields(\Laravel\Nova\Http\Requests\NovaRequest $request, array $methods): \Laravel\Nova\Fields\FieldCollection {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    protected function fieldsMethod(\Laravel\Nova\Http\Requests\NovaRequest $request): string {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  array<int, \Laravel\Nova\Fields\Field>  $fields
     * @return \Laravel\Nova\Fields\FieldCollection<int, \Laravel\Nova\Fields\Field>
     */
    protected function withPivotFields(\Laravel\Nova\Http\Requests\NovaRequest $request, array $fields): \Laravel\Nova\Fields\FieldCollection {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return \Laravel\Nova\Fields\FieldCollection<int, \Laravel\Nova\Fields\Field>
     */
    public function resolvePivotFields(\Laravel\Nova\Http\Requests\NovaRequest $request, string $relatedResource): \Laravel\Nova\Fields\FieldCollection {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    protected function pivotFieldsFor(\Laravel\Nova\Http\Requests\NovaRequest $request, string $relatedResource): \Laravel\Nova\Fields\FieldCollection {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    protected function relatedPivotFieldsFor(\Laravel\Nova\Http\Requests\NovaRequest $request, string $relatedResource): \Laravel\Nova\Fields\FieldCollection {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  array<int, \Laravel\Nova\Fields\Field>  $fields
     */
    protected function indexToInsertPivotFields(\Laravel\Nova\Http\Requests\NovaRequest $request, array $fields): ?int {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    public function pivotNameForField(\Laravel\Nova\Http\Requests\NovaRequest $request, string $field): ?string {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  \Laravel\Nova\Fields\FieldCollection<int, \Laravel\Nova\Fields\Field>  $fields
     * @return \Illuminate\Support\Collection<int, \Laravel\Nova\Panel>
     */
    protected function resolvePanelsFromFields(\Laravel\Nova\Http\Requests\NovaRequest $request, \Laravel\Nova\Fields\FieldCollection $fields, string $label): \Illuminate\Support\Collection {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  \Illuminate\Support\Collection<int, \Laravel\Nova\Panel>  $panels
     * @param  \Laravel\Nova\Fields\FieldCollection<int, \Laravel\Nova\Fields\Field>  $fields
     * @return \Illuminate\Support\Collection<int, \Laravel\Nova\Panel>
     */
    protected function panelsWithDefaultLabel(\Illuminate\Support\Collection $panels, \Laravel\Nova\Fields\FieldCollection $fields, string $label): \Illuminate\Support\Collection {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return \Closure(\Laravel\Nova\Fields\FieldCollection):\Laravel\Nova\Fields\FieldCollection
     */
    protected function fieldResolverCallback(\Laravel\Nova\Http\Requests\NovaRequest $request): \Closure {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return \Closure(\Laravel\Nova\Fields\FieldCollection):\Laravel\Nova\Fields\FieldCollection
     */
    protected function relatedFieldResolverCallback(\Laravel\Nova\Http\Requests\NovaRequest $request): \Closure {
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
    /**
     * @return \Illuminate\Support\Collection<int, \Laravel\Nova\Lenses\Lens>
     */
    public function availableLenses(\Laravel\Nova\Http\Requests\NovaRequest $request): \Illuminate\Support\Collection {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return \Illuminate\Support\Collection<int, \Laravel\Nova\Lenses\Lens>
     */
    public function resolveLenses(\Laravel\Nova\Http\Requests\NovaRequest $request): \Illuminate\Support\Collection {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return array
     */
    public function lenses(\Laravel\Nova\Http\Requests\NovaRequest $request) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
}
