<?php

// Test double of Laravel Nova: public signatures only, not Laravel Nova.

namespace Laravel\Nova\Filters;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use Illuminate\Support\Traits\Macroable;
use JsonSerializable;
use Laravel\Nova\AuthorizedToSee;
use Laravel\Nova\Contracts\Filter as FilterContract;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Makeable;
use Laravel\Nova\Metable;
use Laravel\Nova\Nova;
use Laravel\Nova\ProxiesCanSeeToGate;
use Laravel\Nova\WithComponent;
use Closure;
use Illuminate\Http\Request;
use BadMethodCallException;
use ReflectionClass;
use ReflectionMethod;
use RuntimeException;
use Throwable;
use Illuminate\Support\Arr;
use function Orchestra\Sidekick\is_safe_callable;

abstract class Filter implements \Laravel\Nova\Contracts\Filter, \JsonSerializable
{
    /**
     * @var \Stringable|string
     */
    public $name = null;
    /**
     * @var string
     */
    public $component = 'select-filter';
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
     * @var (callable(\Laravel\Nova\Http\Requests\NovaRequest):(bool))|bool
     */
    public $searchable = false;
    /**
     * @return \Illuminate\Contracts\Database\Eloquent\Builder
     */
    abstract public function apply(\Laravel\Nova\Http\Requests\NovaRequest $request, \Illuminate\Contracts\Database\Eloquent\Builder $query, mixed $value);
    /**
     * @return array
     */
    public function options(\Laravel\Nova\Http\Requests\NovaRequest $request) {
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
    public function key() {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return array|mixed
     */
    public function default() {
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
     * @param  (callable(\Laravel\Nova\Http\Requests\NovaRequest):(bool))|bool  $searchable
     * @return $this
     */
    public function searchable(callable|bool $searchable = true) {
        return $this;
    }
    public function isSearchable(\Laravel\Nova\Http\Requests\NovaRequest $request): bool {
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
