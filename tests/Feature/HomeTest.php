<?php

declare(strict_types=1);

use Laravel\Nova\Nova;

use function Pest\Laravel\get;

it('shows the home page with the versions and a link to Nova', function (): void {
    get(route('home'))
        ->assertOk()
        ->assertViewIs('home')
        ->assertSee(config()->string('app.name'))
        ->assertSee(PHP_VERSION)
        ->assertSee(app()->version())
        ->assertSee(Nova::version())
        ->assertSee(url(Nova::path()));
});

it('lists the packages installed from a local path', function (): void {
    get(route('home'))
        ->assertOk()
        ->assertViewHas('packages', fn (mixed $packages): bool => is_array($packages));
});
