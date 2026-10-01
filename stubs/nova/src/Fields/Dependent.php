<?php

// Test double of Laravel Nova: public signatures only, not Laravel Nova.

namespace Laravel\Nova\Fields;

use Illuminate\Support\Arr;
use Laravel\Nova\Http\Requests\NovaRequest;

/**
 * @internal
 * @phpstan-type TDependentResolver (callable(static, \Laravel\Nova\Http\Requests\NovaRequest, \Laravel\Nova\Fields\FormData):(void))|class-string
 */
class Dependent
{
    /**
     * @var array<int, string>
     */
    public array $context = ['create', 'update'];
    /**
     * @var array<int, string|\Laravel\Nova\Fields\Field>
     */
    public array $attributes = [];
    public ?\Laravel\Nova\Fields\FormData $formData = null;
    /**
     * @param  \Laravel\Nova\Fields\Field|array<int, string|\Laravel\Nova\Fields\Field>|string  $attributes
     * @param  callable|string  $resolver
     * @param  array<int, string>|string|null  $context
     * @phpstan-param TDependentResolver $resolver
     */
    public function __construct(\Laravel\Nova\Fields\Field|array|string $attributes, public $resolver, array|string|null $context = null) {
    }
    /**
     * @return $this
     */
    public function handle(\Laravel\Nova\Fields\Field $field, \Laravel\Nova\Http\Requests\NovaRequest $request) {
        return $this;
    }
    /**
     * @return array<string, mixed>
     */
    public function getAttributes(): array {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
}
