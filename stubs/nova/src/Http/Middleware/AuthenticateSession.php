<?php

// Test double of Laravel Nova: public signatures only, not Laravel Nova.

namespace Laravel\Nova\Http\Middleware;

use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Session\Middleware\AuthenticateSession as Middleware;

class AuthenticateSession extends \Illuminate\Session\Middleware\AuthenticateSession
{
    protected function guard() {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
}
