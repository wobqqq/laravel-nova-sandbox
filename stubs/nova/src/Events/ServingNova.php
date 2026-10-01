<?php

// Test double of Laravel Nova: public signatures only, not Laravel Nova.

namespace Laravel\Nova\Events;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Http\Request;

class ServingNova
{
    public function __construct(public \Illuminate\Contracts\Foundation\Application $app, public \Illuminate\Http\Request $request) {
    }
    /**
     * @param  mixed  ...$arguments
     * @return mixed
     */
    public static function dispatch(...$arguments) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  bool  $boolean
     * @param  mixed  ...$arguments
     * @return mixed
     */
    public static function dispatchIf($boolean, ...$arguments) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  bool  $boolean
     * @param  mixed  ...$arguments
     * @return mixed
     */
    public static function dispatchUnless($boolean, ...$arguments) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    /**
     * @param  mixed  ...$arguments
     * @return \Illuminate\Broadcasting\PendingBroadcast
     */
    public static function broadcast(...$arguments) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
}
