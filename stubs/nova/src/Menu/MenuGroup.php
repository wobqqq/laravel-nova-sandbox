<?php

// Test double of Laravel Nova: public signatures only, not Laravel Nova.

namespace Laravel\Nova\Menu;

use Illuminate\Support\Traits\Macroable;
use JsonSerializable;
use Laravel\Nova\AuthorizedToSee;
use Laravel\Nova\Fields\Collapsable;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Makeable;
use Laravel\Nova\WithComponent;
use Stringable;
use Closure;
use Illuminate\Http\Request;
use BadMethodCallException;
use ReflectionClass;
use ReflectionMethod;
use RuntimeException;
use Throwable;

/**
 * @method static static make(string $name, array $items = [])
 */
class MenuGroup implements \JsonSerializable
{
    /**
     * @var string
     */
    public $component = 'menu-group';
    public \Laravel\Nova\Menu\MenuCollection $items;
    /**
     * @var (\Closure(\Laravel\Nova\Http\Requests\NovaRequest|\Illuminate\Http\Request):(bool))|null
     */
    public $seeCallback = null;
    /**
     * @var bool
     */
    public $collapsable = false;
    /**
     * @var bool
     */
    public $collapsedByDefault = false;
    /**
     * @var array
     */
    protected static $macros = [];
    public function __construct(public \Stringable|string $name, iterable $items = []) {
    }
    public function key(): string {
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
     * @return $this
     */
    public function collapsable() {
        return $this;
    }
    /**
     * @return $this
     */
    public function collapsible() {
        return $this;
    }
    /**
     * @return $this
     */
    public function collapsedByDefault() {
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
