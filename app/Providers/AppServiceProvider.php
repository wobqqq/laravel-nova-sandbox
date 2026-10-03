<?php

declare(strict_types=1);

namespace App\Providers;

use App\Support\LocalPackages;
use Illuminate\Support\ServiceProvider;
use Override;

final class AppServiceProvider extends ServiceProvider
{
    #[Override]
    public function register(): void
    {
        $this->app->bind(LocalPackages::class, static fn (): LocalPackages => LocalPackages::fromComposer());
    }
}
