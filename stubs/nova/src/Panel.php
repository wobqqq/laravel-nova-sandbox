<?php

// Test double of Laravel Nova: public signatures only, not Laravel Nova.

namespace Laravel\Nova;

use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Illuminate\Support\Traits\Macroable;
use Illuminate\Support\Traits\Tappable;
use JsonSerializable;
use Laravel\Nova\Contracts\RelatableField;
use Laravel\Nova\Exceptions\NovaException;
use Laravel\Nova\Fields\Collapsable;
use Laravel\Nova\Fields\FieldCollection;
use Laravel\Nova\Fields\FieldMergeValue;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Metrics\HasHelpText;
use Stringable;
use BadMethodCallException;
use Closure;
use ReflectionClass;
use ReflectionMethod;
use RuntimeException;
use Throwable;

/**
 * @phpstan-import-type TFields from \Laravel\Nova\Resource
 * @phpstan-import-type TPanelFields from \Laravel\Nova\Tabs\TabsGroup
 * @property array<int, TFields>|null $data
 * @method static static make(\Stringable|string $name, callable|iterable $fields = [], ?string $attribute = null)
 */
class Panel extends \Laravel\Nova\Fields\FieldMergeValue implements \JsonSerializable, \Stringable
{
    /**
     * @var \Stringable|string
     */
    public $name = null;
    /**
     * @var string
     */
    public $attribute = null;
    /**
     * @var string
     */
    public $component = 'panel';
    /**
     * @var bool
     */
    public $showToolbar = false;
    /**
     * @var int|null
     */
    public $limit = null;
    /**
     * @var bool
     */
    public $collapsable = false;
    /**
     * @var bool
     */
    public $collapsedByDefault = false;
    /**
     * @var \Stringable|string|null
     */
    public $helpText = null;
    /**
     * @var string|int
     */
    public $helpWidth = 250;
    /**
     * @var array
     */
    protected static $macros = [];
    /**
     * @var array<string, mixed>
     */
    public $meta = [];
    /**
     * @param  \Stringable|string  $name
     * @param  (callable():(iterable))|iterable  $fields
     * @phpstan-param (callable():(TPanelFields))|TPanelFields $fields
     * @return void
     */
    public function __construct($name, \Traversable|callable|array $fields = [], ?string $attribute = null) {
    }
    /**
     * @param  \Stringable|string  $name
     * @param  (callable():(iterable))|iterable  $fields
     * @phpstan-param (callable():(TPanelFields))|TPanelFields $fields
     * @return static
     */
    public static function makeDefault($name, \Traversable|callable|array $fields = [], ?string $attribute = null) {
        return new static();
    }
    /**
     * @param  \Stringable|string  $name
     * @param  \Laravel\Nova\Fields\FieldCollection<int, \Laravel\Nova\Fields\Field>  $fields
     * @phpstan-param \Laravel\Nova\Fields\FieldCollection<int, TFields>  $fields
     * @return \Laravel\Nova\Panel
     */
    public static function mutate($name, \Laravel\Nova\Fields\FieldCollection $fields) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    protected function prepareFields(\Traversable|callable|array $fields): iterable {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  \Laravel\Nova\Resource  $resource
     * @return \Stringable|string
     */
    public static function defaultNameForDetail(\Laravel\Nova\Resource $resource) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  \Laravel\Nova\Resource  $resource
     * @return \Stringable|string
     */
    public static function defaultNameForCreate(\Laravel\Nova\Resource $resource) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  \Laravel\Nova\Resource  $resource
     * @return \Stringable|string
     */
    public static function defaultNameForUpdate(\Laravel\Nova\Resource $resource) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  \Laravel\Nova\Resource  $resource
     * @return \Stringable|string
     */
    public static function defaultNameForViaRelationship(\Laravel\Nova\Resource $resource, \Laravel\Nova\Http\Requests\NovaRequest $request) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return $this
     */
    public function withToolbar() {
        return $this;
    }
    /**
     * @return $this
     */
    public function limit(int $limit) {
        return $this;
    }
    /**
     * @return string
     */
    public function component() {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  string  $helpWidth
     * @return never
     * @throws \Laravel\Nova\Exceptions\HelperNotSupported
     */
    public function helpWidth($helpWidth) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return never
     * @throws \Laravel\Nova\Exceptions\HelperNotSupported
     */
    public function getHelpWidth() {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return $this
     */
    public function withAttribute(string $attribute) {
        return $this;
    }
    /**
     * @return array<string, mixed>
     */
    public function jsonSerialize(): array {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    public function __toString(): string {
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
     * @param  string  $name
     * @param  object|callable  $macro
     * @param-closure-this static  $macro
     * @return void
     */
    public static function macro($name, $macro) {
    }
    /**
     * @param  object  $mixin
     * @param  bool  $replace
     * @return void
     * @throws \ReflectionException
     */
    public static function mixin($mixin, $replace = true) {
    }
    /**
     * @param  string  $name
     * @return bool
     */
    public static function hasMacro($name) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return void
     */
    public static function flushMacros() {
    }
    /**
     * @param  string  $method
     * @param  array  $parameters
     * @return mixed
     * @throws \BadMethodCallException
     */
    public static function __callStatic($method, $parameters) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  string  $method
     * @param  array  $parameters
     * @return mixed
     * @throws \BadMethodCallException
     */
    public function __call($method, $parameters) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return static
     */
    public static function make(...$arguments) {
        return new static(...$arguments);
    }
    /**
     * @return array<string, mixed>
     */
    public function meta() {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  array<string, mixed>  $meta
     * @return $this
     */
    public function withMeta(array $meta) {
        return $this;
    }
    /**
     * @param  (callable($this): mixed)|null  $callback
     * @return ($callback is null ? \Illuminate\Support\HigherOrderTapProxy<$this> : $this)
     */
    public function tap($callback = null) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return $this
     */
    public function withComponent(string $component) {
        return $this;
    }
}
