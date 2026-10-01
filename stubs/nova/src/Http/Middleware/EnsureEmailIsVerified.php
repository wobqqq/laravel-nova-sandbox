<?php

// Test double of Laravel Nova: public signatures only, not Laravel Nova.

namespace Laravel\Nova\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\EnsureEmailIsVerified as Middleware;
use Illuminate\Support\Facades\Route;

class EnsureEmailIsVerified extends \Illuminate\Auth\Middleware\EnsureEmailIsVerified
{
    public function handle($request, \Closure $next, $redirectToRoute = null) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
}
