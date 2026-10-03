<?php

declare(strict_types=1);

namespace App\Providers;

use App\Models\User;
use App\Nova\Dashboards\Main;
use Illuminate\Support\Facades\Gate;
use Laravel\Fortify\Features;
use Laravel\Nova\Dashboard;
use Laravel\Nova\Nova;
use Laravel\Nova\NovaApplicationServiceProvider;
use Laravel\Nova\Tool;
use Override;

final class NovaServiceProvider extends NovaApplicationServiceProvider
{
    /**
     * @return list<Tool>
     */
    #[Override]
    public function tools(): array
    {
        return [];
    }

    #[Override]
    protected function fortify(): void
    {
        Nova::fortify()
            ->features([
                Features::updatePasswords(),
            ])
            ->register();
    }

    #[Override]
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
    #[Override]
    protected function gate(): void
    {
        Gate::define('viewNova', fn (User $user): bool => $user->is_admin);
    }

    /**
     * @return list<Dashboard>
     */
    #[Override]
    protected function dashboards(): array
    {
        return [
            new Main(),
        ];
    }
}
