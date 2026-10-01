<?php

// Test double of Laravel Nova: public signatures only, not Laravel Nova.

namespace Laravel\Nova\Fields;

use Illuminate\Http\Request;
use Laravel\Nova\Contracts\ListableField;
use Laravel\Nova\Contracts\RelatableField;
use Laravel\Nova\Exceptions\NovaException;
use Laravel\Nova\Panel;
use Stringable;

/**
 * @method static static make(\Stringable|string $name, string|null $attribute = null, string|null $resource = null)
 */
class HasMany extends \Laravel\Nova\Fields\Field implements \Laravel\Nova\Contracts\ListableField, \Laravel\Nova\Contracts\RelatableField
{
    /**
     * @var string
     */
    public $component = 'has-many-field';
    /**
     * @var class-string<\Laravel\Nova\Resource>
     */
    public $resourceClass = null;
    /**
     * @var string
     */
    public $resourceName = null;
    /**
     * @var string
     */
    public $hasManyRelationship = null;
    /**
     * @var string|null
     */
    public $singularLabel = null;
    /**
     * @var bool
     */
    public $collapsable = false;
    /**
     * @var bool
     */
    public $collapsedByDefault = false;
    /**
     * @param  \Stringable|string  $name
     * @param  class-string<\Laravel\Nova\Resource>|null  $resource
     */
    public function __construct($name, ?string $attribute = null, ?string $resource = null) {
    }
    public function relationshipName(): string {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    public function relationshipType(): string {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return bool
     */
    public function authorize(\Illuminate\Http\Request $request) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  \Laravel\Nova\Resource|\Illuminate\Database\Eloquent\Model|object  $resource
     */
    public function resolve($resource, ?string $attribute = null): void {
    }
    /**
     * @return $this
     */
    public function singularLabel(\Stringable|string $singularLabel) {
        return $this;
    }
    /**
     * @param  \Stringable|string|null  $text
     * @return never
     * @throws \Laravel\Nova\Exceptions\HelperNotSupported
     */
    public function help($text) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    public function asPanel(): \Laravel\Nova\Panel {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return array<string, mixed>
     */
    public function jsonSerialize(): array {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return $this
     */
    public function collapsable() {
        return $this;
    }
    /**
     * @return $this
     */
    public function collapsible() {
        return $this;
    }
    /**
     * @return $this
     */
    public function collapsedByDefault() {
        return $this;
    }
}
