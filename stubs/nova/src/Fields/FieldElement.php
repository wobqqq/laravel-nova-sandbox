<?php

// Test double of Laravel Nova: public signatures only, not Laravel Nova.

namespace Laravel\Nova\Fields;

use Laravel\Nova\Element;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Panel;

/**
 * @phpstan-type TMixedResource \Illuminate\Database\Eloquent\Model|\Laravel\Nova\Support\Fluent|object|array
 */
abstract class FieldElement extends \Laravel\Nova\Element
{
    /**
     * @var \Laravel\Nova\Panel|null
     */
    public $panel = null;
    /**
     * @var (callable(\Laravel\Nova\Http\Requests\NovaRequest, mixed):(bool))|bool
     * @phpstan-var (callable(\Laravel\Nova\Http\Requests\NovaRequest, TMixedResource):(bool))|bool
     */
    public $showOnIndex = true;
    /**
     * @var (callable(\Laravel\Nova\Http\Requests\NovaRequest, mixed):(bool))|bool
     * @phpstan-var (callable(\Laravel\Nova\Http\Requests\NovaRequest, TMixedResource):(bool))|bool
     */
    public $showOnDetail = true;
    /**
     * @var (callable(\Laravel\Nova\Http\Requests\NovaRequest):(bool))|bool
     */
    public $showOnCreation = true;
    /**
     * @var (callable(\Laravel\Nova\Http\Requests\NovaRequest, mixed):(bool))|bool
     */
    public $showOnUpdate = true;
    /**
     * @param  (callable():(bool))|bool  $callback
     * @return $this
     */
    public function hideFromIndex(callable|bool $callback = true) {
        \func_get_args();
        return $this;
    }
    /**
     * @param  (callable(\Laravel\Nova\Http\Requests\NovaRequest, mixed):(bool))|bool  $callback
     * @return $this
     */
    public function hideFromDetail(callable|bool $callback = true) {
        \func_get_args();
        return $this;
    }
    /**
     * @param  (callable(\Laravel\Nova\Http\Requests\NovaRequest):(bool))|bool  $callback
     * @return $this
     */
    public function hideWhenCreating(callable|bool $callback = true) {
        \func_get_args();
        return $this;
    }
    /**
     * @param  (callable(\Laravel\Nova\Http\Requests\NovaRequest, mixed):(bool))|bool  $callback
     * @return $this
     */
    public function hideWhenUpdating(callable|bool $callback = true) {
        \func_get_args();
        return $this;
    }
    /**
     * @param  (callable(\Laravel\Nova\Http\Requests\NovaRequest, mixed):(bool))|bool  $callback
     * @phpstan-param (callable(\Laravel\Nova\Http\Requests\NovaRequest, TMixedResource):(bool))|bool  $callback
     * @return $this
     */
    public function showOnIndex(callable|bool $callback = true) {
        return $this;
    }
    /**
     * @param  (callable(\Laravel\Nova\Http\Requests\NovaRequest, mixed):(bool))|bool  $callback
     * @phpstan-param (callable(\Laravel\Nova\Http\Requests\NovaRequest, TMixedResource):(bool))|bool  $callback
     * @return $this
     */
    public function showOnDetail(callable|bool $callback = true) {
        return $this;
    }
    /**
     * @param  (callable(\Laravel\Nova\Http\Requests\NovaRequest):(bool))|bool  $callback
     * @return $this
     */
    public function showOnCreating(callable|bool $callback = true) {
        return $this;
    }
    /**
     * @param  (callable(\Laravel\Nova\Http\Requests\NovaRequest, mixed):(bool))|bool  $callback
     * @return $this
     */
    public function showOnUpdating(callable|bool $callback = true) {
        return $this;
    }
    /**
     * @param  \Illuminate\Database\Eloquent\Model|\Laravel\Nova\Support\Fluent|object|array  $resource
     */
    public function isShownOnUpdate(\Laravel\Nova\Http\Requests\NovaRequest $request, $resource): bool {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  \Illuminate\Database\Eloquent\Model|\Laravel\Nova\Support\Fluent|object|array  $resource
     */
    public function isShownOnIndex(\Laravel\Nova\Http\Requests\NovaRequest $request, $resource): bool {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  \Illuminate\Database\Eloquent\Model|\Laravel\Nova\Support\Fluent|object|array  $resource
     */
    public function isShownOnDetail(\Laravel\Nova\Http\Requests\NovaRequest $request, $resource): bool {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    public function isShownOnCreation(\Laravel\Nova\Http\Requests\NovaRequest $request): bool {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return $this
     */
    public function onlyOnIndex() {
        return $this;
    }
    /**
     * @return $this
     */
    public function onlyOnDetail() {
        return $this;
    }
    /**
     * @return $this
     */
    public function onlyOnForms() {
        return $this;
    }
    /**
     * @return $this
     */
    public function exceptOnForms() {
        return $this;
    }
    /**
     * @return array<string, mixed>
     */
    public function jsonSerialize(): array {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
}
