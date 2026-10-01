<?php

// Test double of Laravel Nova: public signatures only, not Laravel Nova.

namespace Laravel\Nova;

use Closure;
use JsonSerializable;
use Stringable;

class Badge implements \JsonSerializable
{
    public const SUCCESS_TYPE = 'success';
    public const WARNING_TYPE = 'warning';
    public const DANGER_TYPE = 'danger';
    public const INFO_TYPE = 'info';
    /**
     * @var array<string, string>
     */
    public static array $types = ['success' => 'bg-green-100 text-green-600 dark:bg-green-500 dark:text-green-900', 'info' => 'bg-sky-100 text-sky-600 dark:bg-sky-600 dark:text-sky-900', 'danger' => 'bg-red-100 text-red-600 dark:bg-red-400 dark:text-red-900', 'warning' => 'bg-yellow-100 text-yellow-600 dark:bg-yellow-300 dark:text-yellow-800'];
    /**
     * @param  string  $value
     */
    public function __construct(public \Closure|\Stringable|string $value, public string $type = 'info') {
    }
    /**
     * @return $this
     */
    public function type(string $type) {
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
