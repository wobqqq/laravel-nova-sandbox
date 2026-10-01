<?php

// Test double of Laravel Nova: public signatures only, not Laravel Nova.

namespace Laravel\Nova\Fields;

use Illuminate\Http\Resources\ConditionallyLoadsAttributes;
use Illuminate\Http\Resources\MergeValue;
use Illuminate\Http\Resources\MissingValue;
use Illuminate\Support\Collection;
use InvalidArgumentException;
use Illuminate\Http\Resources\Attributes\PreserveKeys;
use Illuminate\Support\Arr;
use Illuminate\Support\Stringable;
use ReflectionClass;

/**
 * @phpstan-import-type TFields from \Laravel\Nova\Resource
 * @phpstan-type TPanelFields iterable<int, TFields>
 */
abstract class FieldMergeValue extends \Illuminate\Http\Resources\MergeValue
{
    /**
     * @var array<class-string, bool>
     */
    protected static $cachedPreserveKeysAttributes = [];
    /**
     * @param  string  $offset
     */
    public function __isset($offset): bool {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  string  $offset
     */
    public function __get($offset): mixed {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  (callable():(iterable))|iterable  $fields
     * @phpstan-param (callable():(TPanelFields))|TPanelFields $fields
     * @return array<int, TFields>
     * @phpstan-return TPanelFields
     */
    protected function prepareFields(\Traversable|callable|array $fields): iterable {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  callable(\Laravel\Nova\Fields\Field, int):mixed  $callback
     * @return $this
     */
    public function each(callable $callback) {
        return $this;
    }
    /**
     * @param  array  $data
     * @return array
     */
    protected function filter($data) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  array  $data
     * @param  int  $index
     * @param  array  $merge
     * @param  bool  $numericKeys
     * @return array
     */
    protected function mergeData($data, $index, $merge, $numericKeys) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  array  $data
     * @return array
     */
    protected function removeMissingValues($data) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  bool  $condition
     * @param  mixed  $value
     * @param  mixed  $default
     * @return \Illuminate\Http\Resources\MissingValue|mixed
     */
    protected function when($condition, $value, $default = new \Illuminate\Http\Resources\MissingValue()) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  bool  $condition
     * @param  mixed  $value
     * @param  mixed  $default
     * @return \Illuminate\Http\Resources\MissingValue|mixed
     */
    public function unless($condition, $value, $default = new \Illuminate\Http\Resources\MissingValue()) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  mixed  $value
     * @return \Illuminate\Http\Resources\MergeValue|mixed
     */
    protected function merge($value) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  bool  $condition
     * @param  mixed  $value
     * @param  mixed  $default
     * @return \Illuminate\Http\Resources\MergeValue|mixed
     */
    protected function mergeWhen($condition, $value, $default = new \Illuminate\Http\Resources\MissingValue()) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  bool  $condition
     * @param  mixed  $value
     * @param  mixed  $default
     * @return \Illuminate\Http\Resources\MergeValue|mixed
     */
    protected function mergeUnless($condition, $value, $default = new \Illuminate\Http\Resources\MissingValue()) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  array  $attributes
     * @return \Illuminate\Http\Resources\MergeValue
     */
    protected function attributes($attributes) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  string  $attribute
     * @param  mixed  $value
     * @param  mixed  $default
     * @return \Illuminate\Http\Resources\MissingValue|mixed
     */
    public function whenHas($attribute, $value = null, $default = new \Illuminate\Http\Resources\MissingValue()) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  mixed  $value
     * @param  mixed  $default
     * @return \Illuminate\Http\Resources\MissingValue|mixed
     */
    protected function whenNull($value, $default = new \Illuminate\Http\Resources\MissingValue()) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  mixed  $value
     * @param  mixed  $default
     * @return \Illuminate\Http\Resources\MissingValue|mixed
     */
    protected function whenNotNull($value, $default = new \Illuminate\Http\Resources\MissingValue()) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  string  $attribute
     * @param  mixed  $value
     * @param  mixed  $default
     * @return \Illuminate\Http\Resources\MissingValue|mixed
     */
    protected function whenAppended($attribute, $value = null, $default = new \Illuminate\Http\Resources\MissingValue()) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  string  $relationship
     * @param  mixed  $value
     * @param  mixed  $default
     * @return \Illuminate\Http\Resources\MissingValue|mixed
     */
    protected function whenLoaded($relationship, $value = null, $default = new \Illuminate\Http\Resources\MissingValue()) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  string  $relationship
     * @param  mixed  $value
     * @param  mixed  $default
     * @return \Illuminate\Http\Resources\MissingValue|mixed
     */
    public function whenCounted($relationship, $value = null, $default = new \Illuminate\Http\Resources\MissingValue()) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  string  $relationship
     * @param  string  $column
     * @param  string  $aggregate
     * @param  mixed  $value
     * @param  mixed  $default
     * @return \Illuminate\Http\Resources\MissingValue|mixed
     */
    public function whenAggregated($relationship, $column, $aggregate, $value = null, $default = new \Illuminate\Http\Resources\MissingValue()) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  string  $relationship
     * @param  mixed  $value
     * @param  mixed  $default
     * @return \Illuminate\Http\Resources\MissingValue|mixed
     */
    public function whenExistsLoaded($relationship, $value = null, $default = new \Illuminate\Http\Resources\MissingValue()) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  string  $table
     * @param  mixed  $value
     * @param  mixed  $default
     * @return \Illuminate\Http\Resources\MissingValue|mixed
     */
    protected function whenPivotLoaded($table, $value, $default = new \Illuminate\Http\Resources\MissingValue()) {
        \func_get_args();
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  string  $accessor
     * @param  string  $table
     * @param  mixed  $value
     * @param  mixed  $default
     * @return \Illuminate\Http\Resources\MissingValue|mixed
     */
    protected function whenPivotLoadedAs($accessor, $table, $value, $default = new \Illuminate\Http\Resources\MissingValue()) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  string  $table
     * @return bool
     */
    protected function hasPivotLoaded($table) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  string  $accessor
     * @param  string  $table
     * @return bool
     */
    protected function hasPivotLoadedAs($accessor, $table) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  mixed  $value
     * @param  callable  $callback
     * @param  mixed  $default
     * @return mixed
     */
    protected function transform($value, callable $callback, $default = new \Illuminate\Http\Resources\MissingValue()) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
}
