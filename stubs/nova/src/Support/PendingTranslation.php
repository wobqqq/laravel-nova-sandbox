<?php

// Test double of Laravel Nova: public signatures only, not Laravel Nova.

namespace Laravel\Nova\Support;

use Illuminate\Support\Str;
use Illuminate\Support\Traits\ForwardsCalls;
use JsonSerializable;
use Stringable;
use BadMethodCallException;
use Error;

class PendingTranslation implements \JsonSerializable, \Stringable
{
    /**
     * @var (callable(\Illuminate\Support\Stringable):(\Stringable|string))|null
     */
    public $transformCallback = null;
    /**
     * @param  array<string, string>  $replace
     */
    public function __construct(public ?string $key = null, public array $replace = [], public ?string $locale = null) {
    }
    /**
     * @param  (callable(\Illuminate\Support\Stringable):(\Stringable|string))  $transformCallback
     * @return $this
     */
    public function transform(callable $transformCallback) {
        return $this;
    }
    public function value(?string $locale = null): string {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return mixed
     */
    public function __call(string $method, array $parameters) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    public function __toString(): string {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    #[\ReturnTypeWillChange]
    public function jsonSerialize(): string {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
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
