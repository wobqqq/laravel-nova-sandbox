<?php

// Test double of Laravel Nova: public signatures only, not Laravel Nova.

namespace Laravel\Nova\Query;

use Illuminate\Contracts\Database\Eloquent\Builder as EloquentBuilder;
use Laravel\Nova\Filters\Filter;
use Laravel\Nova\Http\Requests\NovaRequest;

class ApplyFilter
{
    public function __construct(public \Laravel\Nova\Filters\Filter $filter, public mixed $value) {
    }
    public function __invoke(\Laravel\Nova\Http\Requests\NovaRequest $request, \Illuminate\Contracts\Database\Eloquent\Builder $query): \Illuminate\Contracts\Database\Eloquent\Builder {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
}
