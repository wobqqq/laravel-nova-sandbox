<?php

// Test double of Laravel Nova: public signatures only, not Laravel Nova.

namespace Laravel\Nova\Fields\Filters;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Laravel\Nova\Contracts\FilterableField;
use Laravel\Nova\Filters\Filter as BaseFilter;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Makeable;

/**
 * @method static static make(\Laravel\Nova\Contracts\FilterableField&\Laravel\Nova\Fields\Field $field)
 */
abstract class Filter extends \Laravel\Nova\Filters\Filter
{
    /**
     * @param  \Laravel\Nova\Contracts\FilterableField&\Laravel\Nova\Fields\Field  $field
     */
    public function __construct(public \Laravel\Nova\Contracts\FilterableField $field) {
    }
    /**
     * @return string
     */
    public function name() {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return string
     */
    public function key() {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return \Illuminate\Contracts\Database\Eloquent\Builder
     */
    public function apply(\Laravel\Nova\Http\Requests\NovaRequest $request, \Illuminate\Contracts\Database\Eloquent\Builder $query, mixed $value) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return array
     */
    public function serializeField() {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return array<string, mixed>
     */
    public function jsonSerialize(): array {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return static
     */
    public static function make(...$arguments) {
        return new static(...$arguments);
    }
}
