<?php

// Test double of Laravel Nova: public signatures only, not Laravel Nova.

namespace Laravel\Nova;

use JsonSerializable;
use Stringable;

/**
 * @method static static make(self|string|null $url, bool $remote = false)
 */
class URL implements \JsonSerializable, \Stringable
{
    /**
     * @var string|null
     */
    public $url = null;
    /**
     * @var bool
     */
    public $remote = null;
    public function __construct(\Laravel\Nova\URL|string|null $url, bool $remote = false) {
    }
    public static function remote(string $url): static {
        return new static();
    }
    public function get(): ?string {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    public function active(): bool {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    public function __toString(): string {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @return array{url: string, remote: bool}
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
