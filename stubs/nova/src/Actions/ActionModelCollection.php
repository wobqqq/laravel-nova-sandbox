<?php

// Test double of Laravel Nova: public signatures only, not Laravel Nova.

namespace Laravel\Nova\Actions;

use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Laravel\Nova\Http\Requests\ActionRequest;
use Laravel\Nova\Resource;

/**
 * @template TKey of array-key
 * @template TModel of \Illuminate\Database\Eloquent\Model
 * @extends \Illuminate\Database\Eloquent\Collection<TKey, TModel>
 */
class ActionModelCollection extends \Illuminate\Database\Eloquent\Collection
{
    /**
     * @return static<TKey, TModel>
     */
    public function filterForExecution(\Laravel\Nova\Http\Requests\ActionRequest $request): static {
        return $this;
    }
    /**
     * @param  \Laravel\Nova\Actions\Action|\Laravel\Nova\Actions\DestructiveAction  $action
     */
    protected function filterByResourceAuthorization(\Laravel\Nova\Http\Requests\ActionRequest $request, \Laravel\Nova\Resource $resource, \Laravel\Nova\Actions\Action $action): bool {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
}
