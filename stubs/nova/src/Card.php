<?php

// Test double of Laravel Nova: public signatures only, not Laravel Nova.

namespace Laravel\Nova;

abstract class Card extends \Laravel\Nova\Element
{
    public const FULL_WIDTH = 'full';
    public const ONE_THIRD_WIDTH = '1/3';
    public const ONE_HALF_WIDTH = '1/2';
    public const ONE_QUARTER_WIDTH = '1/4';
    public const TWO_THIRDS_WIDTH = '2/3';
    public const THREE_QUARTERS_WIDTH = '3/4';
    public const FIXED_HEIGHT = 'fixed';
    public const DYNAMIC_HEIGHT = 'dynamic';
    /**
     * @var string
     */
    public $width = '1/3';
    /**
     * @var string
     */
    public $height = 'fixed';
    /**
     * @return $this
     */
    public function width(string $width) {
        return $this;
    }
    /**
     * @return $this
     */
    public function height(string $height) {
        return $this;
    }
    /**
     * @return $this
     */
    public function dynamicHeight() {
        return $this;
    }
    /**
     * @return $this
     */
    public function fixedHeight() {
        return $this;
    }
    /**
     * @return array<string, mixed>
     */
    public function jsonSerialize(): array {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
}
