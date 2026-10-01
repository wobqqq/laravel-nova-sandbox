<?php

// Test double of Laravel Nova: public signatures only, not Laravel Nova.

namespace Laravel\Nova\Actions;

use Closure;
use Illuminate\Bus\PendingBatch;
use Illuminate\Contracts\Validation\Validator as ValidatorContract;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Traits\Macroable;
use Illuminate\Support\Traits\Tappable;
use JsonSerializable;
use Laravel\Nova\AuthorizedToSee;
use Laravel\Nova\Exceptions\MissingActionHandlerException;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\FieldCollection;
use Laravel\Nova\Http\Requests\ActionRequest;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Makeable;
use Laravel\Nova\Metable;
use Laravel\Nova\Nova;
use Laravel\Nova\ProxiesCanSeeToGate;
use Laravel\Nova\URL;
use Laravel\Nova\WithComponent;
use ReflectionClass;
use Stringable;
use BadMethodCallException;
use ReflectionMethod;
use RuntimeException;
use Throwable;
use Illuminate\Support\Arr;

/**
 * @phpstan-type TModel \Illuminate\Database\Eloquent\Model
 * @phpstan-type TAuthoriseCallback \Closure(\Laravel\Nova\Http\Requests\NovaRequest):bool
 * @phpstan-property TAuthoriseCallback|null $seeCallback
 * @phpstan-method $this canSee(TAuthoriseCallback $callback)
 * @property \Closure|null $seeCallback
 * @method $this canSee(\Closure $callback)
 */
class Action implements \JsonSerializable
{
    public const FULLSCREEN_STYLE = 'fullscreen';
    public const WINDOW_STYLE = 'window';
    /**
     * @var int
     */
    public static $chunkCount = 200;
    /**
     * @var \Stringable|string
     */
    public $name = null;
    /**
     * @var string|null
     */
    public $uriKey = null;
    /**
     * @var string
     */
    public $component = 'confirm-action-modal';
    /**
     * @var bool
     */
    public $withoutActionEvents = false;
    /**
     * @var bool
     */
    public $withoutConfirmation = false;
    /**
     * @var bool
     */
    public $onlyOnIndex = false;
    /**
     * @var bool
     */
    public $onlyOnDetail = false;
    /**
     * @var bool
     */
    public $showOnIndex = true;
    /**
     * @var bool
     */
    public $showOnDetail = true;
    /**
     * @var bool
     */
    public $showInline = false;
    /**
     * @var string|null
     */
    public $actionBatchId = null;
    /**
     * @var (\Closure(\Laravel\Nova\Http\Requests\NovaRequest, mixed):(bool))|null
     */
    public $runCallback = null;
    /**
     * @var (callable(\Illuminate\Support\Collection):(mixed))|null
     */
    public $thenCallback = null;
    /**
     * @var \Stringable|string
     */
    public $confirmButtonText = 'Run Action';
    /**
     * @var \Stringable|string
     */
    public $cancelButtonText = 'Cancel';
    /**
     * @var \Stringable|string
     */
    public $confirmText = 'Are you sure you want to run this action?';
    /**
     * @var bool
     */
    public $standalone = false;
    /**
     * @var bool
     */
    public $sole = false;
    /**
     * @var string
     */
    public $responseType = 'json';
    /**
     * @var string
     */
    public $modalSize = '2xl';
    /**
     * @var string
     */
    public $modalStyle = 'window';
    /**
     * @var bool|null
     */
    public $authorizedToRunAction = null;
    /**
     * @var (\Closure(\Laravel\Nova\Fields\ActionFields, \Illuminate\Support\Collection):(mixed))|null
     */
    public $handleCallback = null;
    /**
     * @var TModel|null
     */
    public $resource = null;
    /**
     * @var (\Closure(\Laravel\Nova\Http\Requests\NovaRequest|\Illuminate\Http\Request):(bool))|null
     */
    public $seeCallback = null;
    /**
     * @var array
     */
    protected static $macros = [];
    /**
     * @var array<string, mixed>
     */
    public $meta = [];
    /**
     * @param  \Stringable|string  $name
     * @param  \Closure(\Laravel\Nova\Fields\ActionFields, \Illuminate\Support\Collection):(mixed)  $handleUsing
     */
    public static function using($name, \Closure $handleUsing): static {
        return new static();
    }
    /**
     * @param  \Closure(\Laravel\Nova\Fields\ActionFields, \Illuminate\Support\Collection):(mixed)  $callback
     * @return $this
     */
    public function handleUsing(\Closure $callback) {
        return $this;
    }
    /**
     * @return $this
     */
    public function withName(\Stringable|string $name) {
        return $this;
    }
    public static function message(\Stringable|string $message): \Laravel\Nova\Actions\ActionResponse {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    public static function deleted(): \Laravel\Nova\Actions\ActionResponse {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @no-named-arguments
     * @param  (\Closure():(string))|(\Closure(\Illuminate\Database\Eloquent\Model):(string))|string|null  $url
     */
    public static function redirect(\Stringable|string $name, \Closure|string|null $url = null): \Laravel\Nova\Actions\ActionResponse|static {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  callable(\Illuminate\Support\Collection):mixed  $callback
     * @return $this
     */
    public function then(callable $callback) {
        return $this;
    }
    /**
     * @return $this
     */
    public function noop() {
        return $this;
    }
    /**
     * @param  (\Closure():(string))|(\Closure(\Illuminate\Database\Eloquent\Model):(string))|string|array<string, mixed>  $path
     * @param  array<string, mixed>  $options
     */
    public static function push(\Stringable|\Laravel\Nova\URL|string $name, \Closure|\Laravel\Nova\URL|array|string $path, array $options = []): \Laravel\Nova\Actions\ActionResponse|static {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @no-named-arguments
     * @template TVisit of \Laravel\Nova\URL|string
     * @template TQueryString of array<string, mixed>
     * @param  TVisit|\Stringable  $name
     * @param  (\Closure():(TVisit))|(\Closure(\Illuminate\Database\Eloquent\Model):(TVisit))|TVisit|TQueryString  $path
     * @param  TQueryString  $options
     */
    public static function visit(\Stringable|\Laravel\Nova\URL|string $name, \Closure|\Laravel\Nova\URL|array|string $path = [], array $options = []): \Laravel\Nova\Actions\ActionResponse|static {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @no-named-arguments
     * @param  (\Closure():(string))|(\Closure(\Illuminate\Database\Eloquent\Model):(string))|string|null  $url
     */
    public static function openInNewTab(\Stringable|string $name, \Closure|string|null $url = null): \Laravel\Nova\Actions\ActionResponse|static {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  (\Closure():(string))|(\Closure(\Illuminate\Database\Eloquent\Model):(string))|string  $url
     */
    public static function downloadURL(\Stringable|string $name, \Closure|string $url): static {
        return new static();
    }
    public static function download(string $url, \Stringable|string $name): \Laravel\Nova\Actions\ActionResponse {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @no-named-arguments
     * @param  string|array<string, mixed>  $modal
     * @param  (\Closure():(array<string, mixed>))|(\Closure(\Illuminate\Database\Eloquent\Model):(array<string, mixed>))|array<string, mixed>  $data
     */
    public static function modal(\Stringable|string $name, array|string $modal = [], \Closure|array $data = []): \Laravel\Nova\Actions\ActionResponse|static {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return bool
     */
    public function authorizedToRun(\Illuminate\Http\Request $request, $model) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return $this
     */
    public function sole() {
        return $this;
    }
    /**
     * @return $this
     */
    public function showOnDetail() {
        return $this;
    }
    /**
     * @return $this
     */
    public function showInline() {
        return $this;
    }
    /**
     * @return mixed
     */
    public function handleUsingCallback(\Laravel\Nova\Fields\ActionFields $fields, \Illuminate\Support\Collection $models) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return mixed
     * @throws \Laravel\Nova\Exceptions\MissingActionHandlerException|\Throwable
     */
    public function handleRequest(\Laravel\Nova\Http\Requests\ActionRequest $request) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @no-named-arguments
     */
    public static function danger(\Stringable|string $name, ?string $message = null): \Laravel\Nova\Actions\ActionResponse|static {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  array<int, mixed>  $results
     * @return mixed
     */
    public function handleResult(\Laravel\Nova\Fields\ActionFields $fields, array $results) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return array<string, mixed>
     * @throws \Illuminate\Validation\ValidationException
     */
    public function validateFields(\Laravel\Nova\Http\Requests\ActionRequest $request): array {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return array
     */
    public function fields(\Laravel\Nova\Http\Requests\NovaRequest $request) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return void
     */
    protected function afterValidation(\Laravel\Nova\Http\Requests\NovaRequest $request, \Illuminate\Contracts\Validation\Validator $validator) {
    }
    /**
     * @param  bool  $value
     * @return $this
     */
    public function onlyOnIndex($value = true) {
        return $this;
    }
    /**
     * @return $this
     */
    public function exceptOnIndex() {
        return $this;
    }
    /**
     * @param  bool  $value
     * @return $this
     */
    public function onlyOnDetail($value = true) {
        return $this;
    }
    /**
     * @return $this
     */
    public function exceptOnDetail() {
        return $this;
    }
    /**
     * @param  bool  $value
     * @return $this
     */
    public function onlyOnTableRow($value = true) {
        return $this;
    }
    /**
     * @param  bool  $value
     * @return $this
     */
    public function onlyInline($value = true) {
        return $this;
    }
    /**
     * @return $this
     */
    public function exceptOnTableRow() {
        return $this;
    }
    /**
     * @return $this
     */
    public function exceptInline() {
        return $this;
    }
    /**
     * @return $this
     */
    public function showOnIndex() {
        return $this;
    }
    /**
     * @return $this
     */
    public function showOnTableRow() {
        return $this;
    }
    /**
     * @return $this
     */
    public function withActionBatchId(string $actionBatchId) {
        return $this;
    }
    /**
     * @return void
     */
    public function withBatch(\Laravel\Nova\Fields\ActionFields $fields, \Illuminate\Bus\PendingBatch $batch) {
    }
    /**
     * @param  \Closure(\Laravel\Nova\Http\Requests\NovaRequest, mixed):bool  $callback
     * @return $this
     */
    public function canRun(\Closure $callback) {
        return $this;
    }
    /**
     * @return $this
     */
    public function withUriKey(string $uriKey) {
        return $this;
    }
    /**
     * @return $this
     */
    public function withoutConfirmation() {
        return $this;
    }
    /**
     * @return $this
     */
    public function withoutActionEvents() {
        return $this;
    }
    /**
     * @return $this
     */
    public function confirmButtonText(\Stringable|string $text) {
        return $this;
    }
    /**
     * @return $this
     */
    public function cancelButtonText(\Stringable|string $text) {
        return $this;
    }
    /**
     * @return $this
     */
    public function confirmText(\Stringable|string $text) {
        return $this;
    }
    /**
     * @return $this
     */
    public function standalone() {
        return $this;
    }
    /**
     * @return $this
     */
    public function fullscreen() {
        return $this;
    }
    /**
     * @return $this
     */
    public function size(string $size) {
        return $this;
    }
    /**
     * @return array<string, mixed>
     */
    public function jsonSerialize(): array {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return \Stringable|string
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
    public function shownOnDetail(): bool {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    public function shownOnIndex(): bool {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    public function shownOnTableRow(): bool {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    public function isStandalone(): bool {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return array
     */
    public function __sleep() {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return int
     */
    protected function markAsFinished($model) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @param  \Throwable|string  $e
     * @return int
     */
    protected function markAsFailed($model, $e = null) {
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
    public function __call($method, $parameters) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return static
     */
    public static function make(...$arguments) {
        return new static(...$arguments);
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
     * @param  string  $ability
     * @param  array|mixed  $arguments
     * @return $this
     */
    public function canSeeWhen($ability, $arguments = []) {
        return $this;
    }
    /**
     * @param  (callable($this): mixed)|null  $callback
     * @return ($callback is null ? \Illuminate\Support\HigherOrderTapProxy<$this> : $this)
     */
    public function tap($callback = null) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return string
     */
    public function component() {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return $this
     */
    public function withComponent(string $component) {
        return $this;
    }
}
