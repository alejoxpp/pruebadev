<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $email = config('auth.initial_super_user.email');
        $password = config('auth.initial_super_user.password');

        if (! $email || ! $password) {
            throw new \RuntimeException(
                'Define INITIAL_SUPER_USER_EMAIL y INITIAL_SUPER_USER_PASSWORD en .env.'
            );
        }

        User::firstOrCreate(
            ['email' => $email],
            [
                'name' => 'Super Usuario',
                'password' => $password,
                'role' => 'super_usuario',
                'active' => true,
            ]
        );
            }
}
