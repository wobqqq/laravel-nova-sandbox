<?php

// Test double of Laravel Nova: public signatures only, not Laravel Nova.

namespace Laravel\Nova;

use Illuminate\Http\Request;
use Illuminate\Support\Traits\Macroable;
use JsonSerializable;
use Closure;
use BadMethodCallException;
use ReflectionClass;
use ReflectionMethod;
use RuntimeException;
use Throwable;
use Laravel\Nova\Http\Requests\NovaRequest;
use Illuminate\Support\Arr;

/**
 * @method static static make(string|null $component = null)
 */
abstract class Element implements \JsonSerializable
{
    /**
     * @var string
     */
    public $component = null;
    /**
     * @var bool
     */
    public $onlyOnDetail = false;
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
    public function __construct(?string $component = null) {
    }
    /**
     * @return bool
     */
    public function authorize(\Illuminate\Http\Request $request) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return $this
     */
    public function onlyOnDetail() {
        return $this;
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
