<?php

// Test double of Laravel Nova: public signatures only, not Laravel Nova.

namespace Laravel\Nova\Actions\Responses;

use JsonSerializable;

class Redirect implements \JsonSerializable
{
    public function __construct(public string $url, public bool $openInNewTab = false) {
    }
    /**
     * @return $this
     */
    public function usingNewTab() {
        return $this;
    }
    /**
     * @return array{url: string, openInNewTab: bool}
     */
    public function jsonSerialize(): array {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
}
