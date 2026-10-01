<?php

// Test double of Laravel Nova: public signatures only, not Laravel Nova.

namespace Laravel\Nova\Http\Middleware;

use Laravel\Nova\Nova;

class Authorize
{
    /**
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request):mixed  $next
     * @return \Illuminate\Http\Response
     */
    public function handle($request, $next) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
}
