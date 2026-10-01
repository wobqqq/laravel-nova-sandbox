<?php

// Test double of Laravel Nova: public signatures only, not Laravel Nova.

namespace Laravel\Nova\Cards;

use Laravel\Nova\Card;

class Help extends \Laravel\Nova\Card
{
    /**
     * @var string
     */
    public $width = 'full';
    public function component() {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
}
