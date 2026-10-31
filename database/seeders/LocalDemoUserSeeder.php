<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class LocalDemoUserSeeder extends Seeder
{
    /**
     * Seed demo accounts for a local walkthrough.
     */
    public function run(): void
    {
        if (! app()->environment('local')) {
            return;
        }

        $password = env('DEMO_USER_PASSWORD', 'TiketKuDemo2026!');

        foreach ([
            ['name' => 'Admin TiketKu', 'email' => 'admin@tiketku.test', 'role' => 'admin'],
            ['name' => 'Buyer Demo 1', 'email' => 'buyer1@tiketku.test', 'role' => 'buyer'],
            ['name' => 'Buyer Demo 2', 'email' => 'buyer2@tiketku.test', 'role' => 'buyer'],
            ['name' => 'Buyer Demo 3', 'email' => 'buyer3@tiketku.test', 'role' => 'buyer'],
            ['name' => 'Buyer Demo 4', 'email' => 'buyer4@tiketku.test', 'role' => 'buyer'],
            ['name' => 'Buyer Demo 5', 'email' => 'buyer5@tiketku.test', 'role' => 'buyer'],
        ] as $account) {
            $role = $account['role'];
            unset($account['role']);

            $user = User::updateOrCreate(
                ['email' => $account['email']],
                [
                    ...$account,
                    'phone' => null,
                    'email_verified_at' => now(),
                    'password' => $password,
                ],
            );

            $user->syncRoles($role);
        }
    }
}
