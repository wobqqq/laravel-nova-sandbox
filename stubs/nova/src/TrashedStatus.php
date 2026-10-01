<?php

// Test double of Laravel Nova: public signatures only, not Laravel Nova.

namespace Laravel\Nova;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Laravel\Scout\Builder as ScoutBuilder;

enum TrashedStatus: string
{
    case DEFAULT = '';
    case WITH = 'with';
    case ONLY = 'only';
    public static function fromBoolean(bool $withTrashed): static {
        return new static();
    }
    public function name(): string {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    public function applySoftDeleteConstraint(\Illuminate\Contracts\Database\Eloquent\Builder|\Laravel\Scout\Builder $query): \Illuminate\Contracts\Database\Eloquent\Builder|\Laravel\Scout\Builder {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
}
