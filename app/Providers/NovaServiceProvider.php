<?php

declare(strict_types=1);

namespace App\Providers;

use App\Models\User;
use App\Nova\Dashboards\Main;
use Illuminate\Support\Facades\Gate;
use Laravel\Fortify\Features;
use Laravel\Nova\Nova;
use Laravel\Nova\NovaApplicationServiceProvider;

class NovaServiceProvider extends NovaApplicationServiceProvider
{
    /**
     * @return array<int, \Laravel\Nova\Tool>
     */
    public function tools(): array
    {
        return [];
    }

    protected function fortify(): void
    {
        Nova::fortify()
            ->features([
                Features::updatePasswords(),
            ])
            ->register();
    }

    protected function routes(): void
    {
        Nova::routes()
            ->withAuthenticationRoutes(default: true)
            ->withPasswordResetRoutes()
            ->withoutEmailVerificationRoutes()
            ->register();
    }

    /**
     * Nova lets any signed-in user in locally; everywhere else only administrators.
     */
    protected function gate(): void
    {
        Gate::define('viewNova', fn (User $user): bool => $user->is_admin);
    }

    /**
     * @return array<int, \Laravel\Nova\Dashboard>
     */
    protected function dashboards(): array
    {
        return [
            new Main(),
        ];
    }
}
