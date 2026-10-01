<?php

// Test double of Laravel Nova: public signatures only, not Laravel Nova.

namespace Laravel\Nova\Fields;

use Laravel\Nova\Nova;

/**
 * @method static static make(\Stringable|string|null $name = null, string $attribute = 'name')
 */
class UiAvatar extends \Laravel\Nova\Fields\Avatar implements \Laravel\Nova\Fields\Unfillable
{
    /**
     * @var array
     */
    protected $settings = ['size' => 300, 'color' => '7F9CF5', 'background' => 'EBF4FF'];
    /**
     * @param  \Stringable|string|null  $name
     */
    public function __construct($name = null, string $attribute = 'name') {
    }
    /**
     * @param  \Illuminate\Database\Eloquent\Model|\Laravel\Nova\Support\Fluent|object  $resource
     */
    public function resolve($resource, ?string $attribute = null): void {
    }
    /**
     * @return $this
     */
    public function fontSize(int|float $fontSize) {
        return $this;
    }
    /**
     * @return $this
     */
    public function color(string $color) {
        return $this;
    }
    /**
     * @return $this
     */
    public function backgroundColor(string $color) {
        return $this;
    }
    /**
     * @return $this
     */
    public function bold() {
        return $this;
    }
    /**
     * @return array<string, mixed>
     */
    public function jsonSerialize(): array {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
}
