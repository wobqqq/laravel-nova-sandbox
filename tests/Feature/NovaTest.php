<?php

declare(strict_types=1);

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Laravel\Nova\Nova;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertAuthenticatedAs;
use function Pest\Laravel\get;
use function Pest\Laravel\post;

it('sends a guest to the Nova sign-in page', function (): void {
    get(Nova::path())->assertRedirect(Nova::url('/login'));
})->group('nova');

it('shows the Nova sign-in page', function (): void {
    get(Nova::url('/login'))->assertOk();
})->group('nova');

it('lets an administrator into Nova', function (): void {
    actingAs(User::factory()->admin()->create())
        ->get(Nova::url('/dashboards/main'))
        ->assertOk();
})->group('nova');

it('keeps a user who is not an administrator out of Nova', function (): void {
    actingAs(User::factory()->create())
        ->get(Nova::url('/dashboards/main'))
        ->assertForbidden();
})->group('nova');

it('grants viewNova to administrators only', function (): void {
    expect(Gate::forUser(User::factory()->admin()->create())->allows('viewNova'))->toBeTrue()
        ->and(Gate::forUser(User::factory()->create())->allows('viewNova'))->toBeFalse();
});

it('signs an administrator in through Nova', function (): void {
    $user = User::factory()->admin()->create();

    post(Nova::url('/login'), ['email' => $user->email, 'password' => 'password'])
        ->assertRedirect();

    assertAuthenticatedAs($user);
})->group('nova');

it('serves the dashboard cards to an administrator', function (): void {
    actingAs(User::factory()->admin()->create())
        ->getJson('/nova-api/dashboards/main')
        ->assertOk()
        ->assertJsonPath('cards.0.component', 'help-card');
})->group('nova');

it('lists the users in the Nova resource', function (): void {
    $admin = User::factory()->admin()->create();

    actingAs($admin)
        ->getJson('/nova-api/users')
        ->assertOk()
        ->assertJsonPath('resources.0.id.value', $admin->id);
})->group('nova');
