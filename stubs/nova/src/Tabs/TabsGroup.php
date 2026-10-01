<?php

// Test double of Laravel Nova: public signatures only, not Laravel Nova.

namespace Laravel\Nova\Tabs;

use Illuminate\Http\Resources\MergeValue;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Laravel\Nova\Contracts\ListableField;
use Laravel\Nova\Panel;

/**
 * @phpstan-import-type TFields from \Laravel\Nova\Resource
 * @phpstan-import-type TPanelFields from \Laravel\Nova\Fields\FieldMergeValue
 * @phpstan-type TGroupFields iterable<int, TFields|\Laravel\Nova\Tabs\Tab>
 * @method static static make(\Stringable|string|null $name = null, callable|iterable $fields = [], ?string $attribute = null)
 */
class TabsGroup extends \Laravel\Nova\Panel
{
    /**
     * @var string
     */
    public $component = 'tabs-panel';
    public bool $showTitle = true;
    /**
     * @var array<int, \Laravel\Nova\Tabs\Tab>
     */
    public array $tabs = [];
    public int $tabsCount = 0;
    public readonly string $originalName;
    /**
     * @param  \Stringable|string|null  $name
     * @param  (callable():(iterable))|iterable  $fields
     * @phpstan-param (callable():(TGroupFields))|TGroupFields  $fields
     */
    public function __construct($name = null, \Traversable|callable|array $fields = [], ?string $attribute = null) {
    }
    /**
     * @internal
     */
    public static function hydrate(\Laravel\Nova\Tabs\TabsGroup $panel, iterable $fields): void {
    }
    protected function prepareFields(\Traversable|callable|array $fields): iterable {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return \Illuminate\Support\Collection<int, \Laravel\Nova\Tabs\Tab>
     */
    protected function convertFieldsToTabs(\Traversable|callable|array $fields): \Illuminate\Support\Collection {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @internal
     * @return $this
     */
    public function addFields(\Laravel\Nova\Tabs\Tab $tab) {
        return $this;
    }
    /**
     * @return array<string, mixed>
     */
    public function jsonSerialize(): array {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
}
