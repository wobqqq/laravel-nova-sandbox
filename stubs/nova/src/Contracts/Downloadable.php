<?php

// Test double of Laravel Nova: public signatures only, not Laravel Nova.

namespace Laravel\Nova\Contracts;

/**
 * @method \Illuminate\Http\Response toDownloadResponse(\Laravel\Nova\Http\Requests\NovaRequest $request, \Laravel\Nova\Resource $resource)
 * @mixin \Laravel\Nova\Fields\Field
 */
interface Downloadable
{
}
