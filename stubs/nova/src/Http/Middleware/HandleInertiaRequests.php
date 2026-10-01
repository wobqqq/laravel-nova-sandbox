<?php

// Test double of Laravel Nova: public signatures only, not Laravel Nova.

namespace Laravel\Nova\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Inertia\Inertia;
use Inertia\Middleware;
use Inertia\ResponseFactory;
use Laravel\Nova\Http\Resources\UserResource;
use Laravel\Nova\Nova;

class HandleInertiaRequests extends \Inertia\Middleware
{
    protected $rootView = 'nova::layout';
    public function version(\Illuminate\Http\Request $request) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    public function share(\Illuminate\Http\Request $request) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
    public function handle(\Illuminate\Http\Request $request, \Closure $next) {
        throw new \LogicException('The Nova test double does not implement ' . __METHOD__ . '.');
    }
}
