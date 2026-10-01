<?php

// Test double of Laravel Nova: public signatures only, not Laravel Nova.

namespace Laravel\Nova\Actions;

use Illuminate\Support\Collection;
use Laravel\Nova\Http\Requests\NovaRequest;

/**
 * @template TKey of array-key
 * @template TValue of \Laravel\Nova\Actions\Action
 * @extends \Illuminate\Support\Collection<TKey, TValue>
 */
class ActionCollection extends \Illuminate\Support\Collection
{
    /**
     * @return static<TKey, TValue>
     */
    public function authorizedToSeeOnIndex(\Laravel\Nova\Http\Requests\NovaRequest $request) {
        return $this;
    }
    /**
     * @return static<TKey, TValue>
     */
    public function authorizedToSeeOnDetail(\Laravel\Nova\Http\Requests\NovaRequest $request) {
        return $this;
    }
    /**
     * @return static<TKey, TValue>
     */
    public function authorizedToSeeOnTableRow(\Laravel\Nova\Http\Requests\NovaRequest $request) {
        return $this;
    }
    /**
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return $this
     */
    public function withAuthorizedToRun(\Laravel\Nova\Http\Requests\NovaRequest $request, $model) {
        return $this;
    }
    /**
     * @return array{sole: int, standalone: int, resource: int}
     */
    public function countsByTypeOnIndex(): array {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
}
