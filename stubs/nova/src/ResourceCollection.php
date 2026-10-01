<?php

// Test double of Laravel Nova: public signatures only, not Laravel Nova.

namespace Laravel\Nova;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;

/**
 * @template TKey of array-key
 * @template TValue
 * @extends \Illuminate\Support\Collection<TKey, TValue>
 */
class ResourceCollection extends \Illuminate\Support\Collection
{
    /**
     * @return static<TKey, TValue>
     */
    public function authorized(\Illuminate\Http\Request $request) {
        return $this;
    }
    /**
     * @return static<TKey, TValue>
     */
    public function availableForNavigation(\Illuminate\Http\Request $request) {
        return $this;
    }
    /**
     * @return static<TKey, TValue>
     */
    public function globallySearchable() {
        return $this;
    }
    /**
     * @return static<TKey, TValue>
     */
    public function searchable() {
        return $this;
    }
    /**
     * @return \Illuminate\Support\Collection<string, \Laravel\Nova\ResourceCollection<array-key, TValue>>
     */
    public function grouped() {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return \Illuminate\Support\Collection<string, \Laravel\Nova\ResourceCollection<array-key, TValue>>
     */
    public function groupedForNavigation(\Illuminate\Http\Request $request) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
}
