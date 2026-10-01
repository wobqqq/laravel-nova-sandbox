<?php

// Test double of Laravel Nova: public signatures only, not Laravel Nova.

namespace Laravel\Nova\Contracts;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Laravel\Nova\Http\Requests\NovaRequest;

interface Filter
{
    /**
     * @return string
     */
    public function key();
    /**
     * @return \Illuminate\Contracts\Database\Eloquent\Builder
     */
    public function apply(\Laravel\Nova\Http\Requests\NovaRequest $request, \Illuminate\Contracts\Database\Eloquent\Builder $query, mixed $value);
    /**
     * @return bool
     */
    public function authorizedToSee(\Illuminate\Http\Request $request);
}
