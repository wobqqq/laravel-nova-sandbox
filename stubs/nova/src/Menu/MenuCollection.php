<?php

// Test double of Laravel Nova: public signatures only, not Laravel Nova.

namespace Laravel\Nova\Menu;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use JsonSerializable;

/**
 * @template TKey of int
 * @template TValue of \Laravel\Nova\Menu\MenuGroup|\Laravel\Nova\Menu\MenuItem|\Laravel\Nova\Menu\MenuList|non-empty-array
 * @extends \Illuminate\Support\Collection<TKey, TValue>
 */
class MenuCollection extends \Illuminate\Support\Collection
{
    /**
     * @return static<int, TValue>
     */
    public function authorized(\Illuminate\Http\Request $request) {
        return $this;
    }
    /**
     * @return static<int, TValue>
     */
    public function withoutEmptyItems() {
        return $this;
    }
}
