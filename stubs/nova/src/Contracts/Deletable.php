<?php

// Test double of Laravel Nova: public signatures only, not Laravel Nova.

namespace Laravel\Nova\Contracts;

/**
 * @mixin \Laravel\Nova\Fields\Field
 * @property callable(\Laravel\Nova\Http\Requests\NovaRequest, mixed, ?string, ?string):mixed $deleteCallback
 */
interface Deletable
{
    /**
     * @param  callable(\Laravel\Nova\Http\Requests\NovaRequest, mixed, ?string, ?string):mixed  $deleteCallback
     * @return $this
     */
    public function delete(callable $deleteCallback);
    /**
     * @return $this
     */
    public function deletable(bool $deletable = true);
    /**
     * @return bool
     */
    public function isPrunable();
    /**
     * @param  bool  $prunable
     * @return $this
     */
    public function prunable($prunable = true);
}
