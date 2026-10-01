<?php

// Test double of Laravel Nova: public signatures only, not Laravel Nova.

namespace Laravel\Nova\Http\Requests;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Collection;
use Laravel\Nova\Contracts\RelatableField;
use function Orchestra\Sidekick\Eloquent\table_name;
use Laravel\Nova\Filters\FilterDecoder;
use Laravel\Nova\Lenses\Lens;
use Laravel\Nova\Query\Search;

/**
 * @property-read string|null $orderBy
 * @property-read string|null $orderByDirection
 */
class LensRequest extends \Laravel\Nova\Http\Requests\NovaRequest
{
    protected bool $tableOrderPrefix = true;
    public function withFilters(\Illuminate\Contracts\Database\Eloquent\Builder $query): \Illuminate\Contracts\Database\Eloquent\Builder {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    public function filter(\Illuminate\Contracts\Database\Eloquent\Builder $query): \Illuminate\Contracts\Database\Eloquent\Builder {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @template TValue of \Illuminate\Contracts\Database\Eloquent\Builder
     * @param  TValue  $query
     * @param  (callable(TValue): (TValue))|null  $defaultCallback
     * @return TValue
     */
    public function withOrdering(\Illuminate\Contracts\Database\Eloquent\Builder $query, $defaultCallback = null): \Illuminate\Contracts\Database\Eloquent\Builder {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return $this
     */
    public function withoutTableOrderPrefix() {
        return $this;
    }
    protected function availableFilters(): \Illuminate\Support\Collection {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    public function toResources(\Illuminate\Support\Collection $models): \Illuminate\Support\Collection {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    protected function getRelationForeignKeyName(\Illuminate\Database\Eloquent\Relations\Relation $relation): string {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    public function perPage(): int {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    public function isActionRequest(): bool {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    public function filters(): \Illuminate\Support\Collection {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    public function lens(): \Laravel\Nova\Lenses\Lens {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    public function availableLenses(): \Illuminate\Support\Collection {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    public function newSearchQuery(): \Illuminate\Contracts\Database\Eloquent\Builder {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    protected function lensExists(): bool {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
}
