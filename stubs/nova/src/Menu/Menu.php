<?php

// Test double of Laravel Nova: public signatures only, not Laravel Nova.

namespace Laravel\Nova\Menu;

use Illuminate\Support\Collection;
use Illuminate\Support\Traits\Conditionable;
use JsonSerializable;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Makeable;
use Closure;
use Illuminate\Support\HigherOrderWhenProxy;

/**
 * @phpstan-type TMenu \Laravel\Nova\Menu\MenuGroup|\Laravel\Nova\Menu\MenuItem|\Laravel\Nova\Menu\MenuList|\Laravel\Nova\Menu\MenuSection
 * @method static static make(array|iterable $items = [])
 */
class Menu implements \JsonSerializable
{
    public \Illuminate\Support\Collection $items;
    public function __construct(iterable $items = []) {
    }
    /**
     * @return self|static
     */
    public static function wrap(\Laravel\Nova\Menu\Menu|\Traversable|array $menu) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  \JsonSerializable|iterable  $items
     * @phpstan-param TMenu|iterable $items
     * @return $this
     */
    public function push(\Laravel\Nova\Menu\MenuGroup|\Laravel\Nova\Menu\MenuItem|\Laravel\Nova\Menu\MenuList|\Laravel\Nova\Menu\MenuSection|\Traversable|array $items = []) {
        return $this;
    }
    /**
     * @param  \JsonSerializable|iterable  $items
     * @phpstan-param TMenu|iterable $items
     * @return $this
     */
    public function append(\Laravel\Nova\Menu\MenuGroup|\Laravel\Nova\Menu\MenuItem|\Laravel\Nova\Menu\MenuList|\Laravel\Nova\Menu\MenuSection|\Traversable|array $items = []) {
        return $this;
    }
    /**
     * @param  \JsonSerializable|iterable  $items
     * @phpstan-param TMenu|iterable $items
     * @return $this
     */
    public function prepend(\Laravel\Nova\Menu\MenuGroup|\Laravel\Nova\Menu\MenuItem|\Laravel\Nova\Menu\MenuList|\Laravel\Nova\Menu\MenuSection|\Traversable|array $items = []) {
        return $this;
    }
    /**
     * @return array<array-key, mixed>
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
    /**
     * @return static
     */
    public static function make(...$arguments) {
        return new static(...$arguments);
    }
}
