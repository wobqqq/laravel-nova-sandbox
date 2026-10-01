<?php

// Test double of Laravel Nova: public signatures only, not Laravel Nova.

namespace Laravel\Nova\Metrics;

use Carbon\CarbonInterface;
use Closure;
use DateInterval;
use DateTimeImmutable;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Laravel\Nova\Card;
use Laravel\Nova\Exceptions\HelperNotSupported;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Nova;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Laravel\Nova\Filters\FilterDecoder;

abstract class Metric extends \Laravel\Nova\Card
{
    /**
     * @var \Stringable|string
     */
    public $name = null;
    /**
     * @var bool
     */
    public $refreshWhenActionRuns = false;
    /**
     * @var bool
     */
    public $refreshWhenFiltersChange = false;
    /**
     * @var \Stringable|string|null
     */
    public $helpText = null;
    /**
     * @var string|int
     */
    public $helpWidth = 250;
    protected ?\Illuminate\Support\Collection $filters = null;
    /**
     * @return mixed
     */
    public function resolve(\Laravel\Nova\Http\Requests\NovaRequest $request) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return \Closure(): mixed
     */
    public function getResolver(\Laravel\Nova\Http\Requests\NovaRequest $request): \Closure {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return string
     */
    public function getCacheKey(\Laravel\Nova\Http\Requests\NovaRequest $request) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return \Stringable|string
     */
    public function name() {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return \DateTimeInterface|\DateInterval|float|int|null
     */
    public function cacheFor() {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return string
     */
    public function uriKey() {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return $this
     */
    public function refreshWhenActionsRun(bool $value = true) {
        return $this;
    }
    /**
     * @return $this
     */
    public function refreshWhenActionRuns(bool $value = true) {
        return $this;
    }
    /**
     * @return $this
     * @throws \Laravel\Nova\Exceptions\HelperNotSupported
     */
    public function refreshWhenFiltersChange(bool $value = true) {
        return $this;
    }
    /**
     * @return $this
     * @throws \Laravel\Nova\Exceptions\HelperNotSupported
     */
    public function onlyOnDetail() {
        return $this;
    }
    /**
     * @return array<string, mixed>
     */
    public function jsonSerialize(): array {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    protected function asQueryDatetime(\Carbon\CarbonInterface $datetime): \Carbon\CarbonInterface {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    protected function formatQueryDateBetween(array $ranges): array {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  \Stringable|string|null  $text
     * @return $this
     */
    public function help($text) {
        return $this;
    }
    /**
     * @return \Stringable|string
     */
    public function getHelpText() {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return $this
     */
    public function helpWidth(string|int $helpWidth) {
        return $this;
    }
    /**
     * @return string|int
     */
    public function getHelpWidth() {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return $this
     */
    public function setAvailableFilters(\Illuminate\Support\Collection $filters) {
        return $this;
    }
    public function applyFilterQuery(\Laravel\Nova\Http\Requests\NovaRequest $request, \Illuminate\Contracts\Database\Eloquent\Builder $query): \Illuminate\Contracts\Database\Eloquent\Builder {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
}
