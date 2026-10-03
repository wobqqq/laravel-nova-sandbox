<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

final class DatabaseSeeder extends Seeder
{
    public const string ADMIN_EMAIL = 'admin@example.com';

    public function run(): void
    {
        $admin = User::query()->firstOrNew(['email' => self::ADMIN_EMAIL]);

        $admin->forceFill([
            'name' => 'Admin',
            'password' => 'password',
            'is_admin' => true,
            'email_verified_at' => now(),
        ])->save();
    }
}
