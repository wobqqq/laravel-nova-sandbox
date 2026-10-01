<?php

// Test double of Laravel Nova: public signatures only, not Laravel Nova.

namespace Laravel\Nova;

use DateTime;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Str;
use Stringable;

/**
 * @method static static make(self|\Stringable|string $name, string|null $path, bool|null $remote = null)
 */
abstract class Asset implements \Illuminate\Contracts\Support\Responsable
{
    /**
     * @var \Stringable|string
     */
    protected $name = null;
    /**
     * @var string|null
     */
    protected $path = null;
    /**
     * @var bool
     */
    protected $remote = false;
    public function __construct(\Laravel\Nova\Asset|\Stringable|string $name, ?string $path, ?bool $remote = null) {
    }
    public static function remote(string $path): static {
        return new static();
    }
    public function name(): \Stringable|string {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    public function path(): ?string {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    public function isRemote(): bool {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function toResponse($request) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    abstract public function url(): string;
    /**
     * @return array<string, string>
     */
    abstract public function toResponseHeaders(): array;
    /**
     * @return static
     */
    public static function make(...$arguments) {
        return new static(...$arguments);
    }
}
