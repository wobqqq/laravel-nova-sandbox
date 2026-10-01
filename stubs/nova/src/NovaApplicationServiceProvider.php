<?php

// Test double of Laravel Nova: public signatures only, not Laravel Nova.

namespace Laravel\Nova;

use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Laravel\Nova\Events\ServingNova;
use Laravel\Nova\Exceptions\NovaExceptionHandler;

class NovaApplicationServiceProvider extends \Illuminate\Support\ServiceProvider
{
    /**
     * @return void
     */
    public function boot() {
        \Laravel\Nova\Nova::serving(function (): void {
            $this->authorization();
            $this->resources();
            \Laravel\Nova\Nova::dashboards($this->dashboards());
            \Laravel\Nova\Nova::tools($this->tools());
        });
    }
    /**
     * @return void
     */
    protected function bootAuthentication() {
    }
    /**
     * @return void
     */
    protected function bootRoutes() {
        $this->routes();
    }
    /**
     * @return void
     */
    protected function fortify() {
        \Laravel\Nova\Nova::fortify()->register();
    }
    /**
     * @return void
     */
    protected function routes() {
        \Laravel\Nova\Nova::routes()->register();
    }
    /**
     * @return void
     */
    protected function authorization() {
        \Laravel\Nova\Nova::auth(static fn ($request): bool => app()->environment('local') || \Illuminate\Support\Facades\Gate::check('viewNova', [\Laravel\Nova\Nova::user($request)]));
    }
    /**
     * @return void
     */
    protected function gate() {
        \Illuminate\Support\Facades\Gate::define('viewNova', static fn ($user): bool => false);
    }
    /**
     * @return array
     */
    protected function dashboards() {
        return [];
    }
    /**
     * @return array
     */
    public function tools() {
        return [];
    }
    /**
     * @return void
     */
    protected function registerExceptionHandler() {
    }
    /**
     * @return void
     */
    protected function resources() {
        \Laravel\Nova\Nova::resourcesIn(app_path('Nova'));
    }
    /**
     * @return void
     */
    public function register() {
        $this->fortify();
        
        $this->booted(function (): void {
            $this->gate();
            $this->bootAuthentication();
            $this->bootRoutes();
        });
    }
}
