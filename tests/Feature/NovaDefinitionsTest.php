<?php

declare(strict_types=1);

use App\Models\User;
use App\Nova\Dashboards\Main;
use App\Nova\User as UserResource;
use App\Providers\NovaServiceProvider;
use Laravel\Nova\Cards\Help;
use Laravel\Nova\Events\ServingNova;
use Laravel\Nova\Http\Requests\NovaRequest;

it('defines the fields of the user resource', function (): void {
    $fields = new UserResource(new User())->fields(NovaRequest::create('/'));

    expect($fields)->toHaveCount(6);
});

it('shows the help card on the main dashboard', function (): void {
    $cards = new Main()->cards();

    expect($cards)->toHaveCount(1)
        ->and($cards[0] ?? null)->toBeInstanceOf(Help::class);
});

it('registers no tools and serves the main dashboard', function (): void {
    $provider = app()->getProvider(NovaServiceProvider::class);
    assert($provider instanceof NovaServiceProvider);

    event(new ServingNova(app(), NovaRequest::create('/')));

    expect($provider->tools())->toBe([]);
});
