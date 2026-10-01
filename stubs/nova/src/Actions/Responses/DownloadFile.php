<?php

// Test double of Laravel Nova: public signatures only, not Laravel Nova.

namespace Laravel\Nova\Actions\Responses;

use JsonSerializable;
use Stringable;

class DownloadFile implements \JsonSerializable
{
    public function __construct(public string $url, public \Stringable|string $name) {
    }
    /**
     * @return array{url: string, name: \Stringable|string}
     */
    public function jsonSerialize(): array {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
}
