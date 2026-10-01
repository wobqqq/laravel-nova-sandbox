<?php

// Test double of Laravel Nova: public signatures only, not Laravel Nova.

namespace Laravel\Nova\Tabs;

use Illuminate\Support\Str;
use JsonSerializable;
use Laravel\Nova\Fields\FieldMergeValue;
use Laravel\Nova\Makeable;
use Stringable;

/**
 * @phpstan-import-type TFields from \Laravel\Nova\Resource
 * @phpstan-import-type TPanelFields from \Laravel\Nova\Fields\FieldMergeValue
 * @phpstan-import-type TGroupFields from \Laravel\Nova\Tabs\TabsGroup
 * @method static static make(\Stringable|string $name, callable|array $fields, ?string $attribute = null)
 */
class Tab extends \Laravel\Nova\Fields\FieldMergeValue implements \JsonSerializable
{
    public \Stringable|string $name;
    public string $attribute;
    public int $position = 0;
    /**
     * @param  \Stringable|string  $name
     * @param  (callable():(iterable))|iterable  $fields
     * @phpstan-param (callable():(TPanelFields))|TPanelFields $fields
     */
    public function __construct($name, \Traversable|callable|array $fields, ?string $attribute = null) {
    }
    /**
     * @param  \Stringable|string|null  $name
     * @param  (callable():(iterable))|iterable  $fields
     * @phpstan-param (callable():(TGroupFields))|TGroupFields $fields
     * @return \Laravel\Nova\Tabs\TabsGroup
     */
    public static function group($name = null, \Traversable|callable|array $fields = [], ?string $attribute = null) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @internal
     * @param  (callable():(iterable))|iterable  $fields
     * @phpstan-param (callable():(TPanelFields))|TPanelFields $fields
     * @return static
     */
    public static function mutate(\Laravel\Nova\Tabs\Tab $tab, \Traversable|callable|array $fields) {
        return new static();
    }
    /**
     * @return $this
     */
    public function withAttribute(string $attribute) {
        return $this;
    }
    /**
     * @internal
     * @return $this
     */
    public function withPosition(int $position) {
        return $this;
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
