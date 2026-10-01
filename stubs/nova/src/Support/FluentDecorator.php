<?php

// Test double of Laravel Nova: public signatures only, not Laravel Nova.

namespace Laravel\Nova\Support;

use ArrayAccess;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Support\Traits\ForwardsCalls;
use JsonSerializable;
use BadMethodCallException;
use Error;

/**
 * @template TKey of array-key
 * @template TValue
 * @implements \Illuminate\Contracts\Support\Arrayable<TKey, TValue>
 * @implements \ArrayAccess<TKey, TValue>
 * @mixin \Illuminate\Support\Fluent
 */
abstract class FluentDecorator implements \Illuminate\Contracts\Support\Arrayable, \ArrayAccess, \Illuminate\Contracts\Support\Jsonable, \JsonSerializable
{
    /**
     * @var \Illuminate\Support\Fluent<TKey, TValue>
     */
    protected $fluent = null;
    /**
     * @param  iterable<TKey, TValue>  $attributes
     */
    public function __construct($attributes = []) {
    }
    /**
     * @return array<TKey, TValue>
     */
    public function toArray() {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return array<TKey, TValue>
     */
    public function jsonSerialize(): array {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  int  $options
     * @return string
     */
    public function toJson($options = 0) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  TKey  $offset
     */
    public function offsetExists($offset): bool {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  TKey  $offset
     * @return TValue|null
     */
    public function offsetGet($offset): mixed {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  TKey  $offset
     * @param  TValue  $value
     */
    public function offsetSet($offset, $value): void {
    }
    /**
     * @param  TKey  $offset
     */
    public function offsetUnset($offset): void {
    }
    /**
     * @param  TKey  $method
     * @param  array{0: ?TValue}  $parameters
     * @return $this
     */
    public function __call($method, $parameters) {
        return $this;
    }
    /**
     * @param  TKey  $key
     * @return TValue|null
     */
    public function __get($key) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  TKey  $key
     * @param  TValue  $value
     * @return void
     */
    public function __set($key, $value) {
    }
    /**
     * @param  TKey  $key
     * @return bool
     */
    public function __isset($key) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  TKey  $key
     * @return void
     */
    public function __unset($key) {
    }
    /**
     * @param  mixed  $object
     * @param  string  $method
     * @param  array  $parameters
     * @return mixed
     * @throws \BadMethodCallException
     */
    protected function forwardCallTo($object, $method, $parameters) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  mixed  $object
     * @param  string  $method
     * @param  array  $parameters
     * @return mixed
     * @throws \BadMethodCallException
     */
    protected function forwardDecoratedCallTo($object, $method, $parameters) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  string  $method
     * @return never
     * @throws \BadMethodCallException
     */
    protected static function throwBadMethodCallException($method) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
}
