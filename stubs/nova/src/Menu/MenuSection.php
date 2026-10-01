<?php

// Test double of Laravel Nova: public signatures only, not Laravel Nova.

namespace Laravel\Nova\Menu;

use Illuminate\Support\Traits\Conditionable;
use Illuminate\Support\Traits\Macroable;
use JsonSerializable;
use Laravel\Nova\AuthorizedToSee;
use Laravel\Nova\Exceptions\NovaException;
use Laravel\Nova\Fields\Collapsable;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Makeable;
use Laravel\Nova\URL;
use Laravel\Nova\WithBadge;
use Laravel\Nova\WithComponent;
use Laravel\Nova\WithIcon;
use Stringable;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\HigherOrderWhenProxy;
use BadMethodCallException;
use ReflectionClass;
use ReflectionMethod;
use RuntimeException;
use Throwable;
use function Orchestra\Sidekick\is_safe_callable;

/**
 * @method static static make(\Stringable|string $name, array|iterable $items = [], string $icon = 'collection')
 */
class MenuSection implements \JsonSerializable
{
    /**
     * @var string
     */
    public $component = 'menu-section';
    /**
     * @var string|null
     */
    public $icon = null;
    /**
     * @var \Laravel\Nova\URL|string|null
     */
    public $path = null;
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
    /**
     * @var (\Closure():(\Laravel\Nova\Badge|string|false))|(callable():(\Laravel\Nova\Badge|string|false))|\Laravel\Nova\Badge|string|false|null
     */
    public $badgeCallback = null;
    /**
     * @var string
     */
    public $badgeType = 'info';
    /**
     * @param  array|iterable  $items
     */
    public function __construct(public \Stringable|string $name, iterable $items = [], ?string $icon = 'collection') {
    }
    /**
     * @param  class-string<\Laravel\Nova\Dashboard>  $dashboard
     * @return static
     */
    public static function dashboard(string $dashboard) {
        return new static();
    }
    /**
     * @param  class-string<\Laravel\Nova\Resource>  $resourceClass
     * @return static
     */
    public static function resource(string $resourceClass) {
        return new static();
    }
    /**
     * @param  class-string<\Laravel\Nova\Resource>  $resourceClass
     * @param  class-string<\Laravel\Nova\Lenses\Lens>  $lensClass
     * @return static
     */
    public static function lens(string $resourceClass, string $lensClass) {
        return new static();
    }
    /**
     * @return $this
     * @throws \Laravel\Nova\Exceptions\NovaException
     */
    public function path(\Laravel\Nova\URL|string|null $href) {
        return $this;
    }
    /**
     * @return $this
     * @throws \Laravel\Nova\Exceptions\NovaException
     */
    public function collapsable() {
        return $this;
    }
    /**
     * @return $this
     */
    public function icon(string $icon) {
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
     * @param  \Laravel\Nova\Badge|(callable():(\Laravel\Nova\Badge|string|false))|string  $badgeCallback
     * @return $this
     */
    public function withBadge(\Laravel\Nova\Badge|callable|string $badgeCallback, string $type = 'info') {
        return $this;
    }
    /**
     * @param  \Laravel\Nova\Badge|(callable():(\Laravel\Nova\Badge|string|false))|string  $badgeCallback
     * @param  (\Closure():(bool))|bool  $condition
     * @return $this
     */
    public function withBadgeIf(\Laravel\Nova\Badge|callable|string $badgeCallback, string $type, \Closure|bool $condition) {
        return $this;
    }
    /**
     * @throws \Exception
     */
    public function resolveBadge(): ?\Laravel\Nova\Badge {
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
    /**
     * @param  string|null  $icon
     * @return $this
     */
    public function withIcon($icon) {
        return $this;
    }
}
