<?php

declare(strict_types=1);

use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Support\Facades\Hash;

use function Pest\Laravel\seed;

it('hashes the password and hides the secrets', function (): void {
    $user = User::factory()->create(['password' => 'secret-password']);

    expect(Hash::check('secret-password', $user->password))->toBeTrue()
        ->and($user->toArray())->not->toHaveKeys(['password', 'remember_token']);
});

it('is not an administrator unless made one', function (): void {
    expect(User::factory()->create()->is_admin)->toBeFalse()
        ->and(User::factory()->admin()->create()->is_admin)->toBeTrue();
});

it('does not take the administrator flag from mass assignment', function (): void {
    $user = new User(['name' => 'Someone', 'email' => 'someone@example.com', 'password' => 'password', 'is_admin' => true]);

    expect($user->is_admin)->toBeNull();
});

it('seeds one administrator, also when run twice', function (): void {
    seed(DatabaseSeeder::class);
    seed(DatabaseSeeder::class);

    $admin = User::query()->where('email', DatabaseSeeder::ADMIN_EMAIL)->sole();

    expect($admin->is_admin)->toBeTrue()
        ->and(Hash::check('password', $admin->password))->toBeTrue()
        ->and($admin->email_verified_at)->not->toBeNull();
});
