<?php

// Test double of Laravel Nova: public signatures only, not Laravel Nova.

namespace Laravel\Nova\Http\Middleware;

use Closure;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Laravel\Nova\Exceptions\AuthenticationException as NovaAuthenticationException;

class Authenticate extends \Illuminate\Auth\Middleware\Authenticate
{
    public function handle($request, \Closure $next, ...$guards) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
}
