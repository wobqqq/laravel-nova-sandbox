<?php

// Test double of Laravel Nova: public signatures only, not Laravel Nova.

namespace Laravel\Nova\Contracts;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Contracts\Database\Query\Builder as BaseBuilder;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Support\LazyCollection;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\TrashedStatus;

/**
 * @method $this tap(callable(\Illuminate\Contracts\Database\Eloquent\Builder):void $callback)
 */
interface QueryBuilder
{
    /**
     * @return $this
     */
    public function whereKey(\Illuminate\Contracts\Database\Eloquent\Builder $query, string|int $key);
    /**
     * @param  array<int, \Laravel\Nova\Query\ApplyFilter>  $filters
     * @param  array<string, string>  $orderings
     * @return $this
     */
    public function search(\Laravel\Nova\Http\Requests\NovaRequest $request, \Illuminate\Contracts\Database\Eloquent\Builder $query, ?string $search = null, array $filters = [], array $orderings = [], \Laravel\Nova\TrashedStatus $withTrashed = \Laravel\Nova\TrashedStatus::DEFAULT);
    /**
     * @return $this
     */
    public function take(?int $limit);
    /**
     * @return $this
     */
    public function limit(?int $limit);
    public function get(): \Illuminate\Database\Eloquent\Collection;
    public function lazy(int $chunkSize = 1000): \Illuminate\Support\LazyCollection;
    public function cursor(): \Illuminate\Support\LazyCollection;
    /**
     * @return array{0: \Illuminate\Contracts\Pagination\Paginator, 1: int|null, 2: bool}
     */
    public function paginate(int $perPage): array;
    public function toBase(): \Illuminate\Contracts\Database\Eloquent\Builder;
    public function toBaseQueryBuilder(): \Illuminate\Contracts\Database\Query\Builder;
}
