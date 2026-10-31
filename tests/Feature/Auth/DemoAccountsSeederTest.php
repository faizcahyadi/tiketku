<?php

use App\Models\User;
use Database\Seeders\DatabaseSeeder;

it('seeds repeatable verified demo accounts only in the local environment', function () {
    $this->app->detectEnvironment(fn (): string => 'local');

    $this->seed(DatabaseSeeder::class);
    $this->seed(DatabaseSeeder::class);

    $admin = User::where('email', 'admin@tiketku.test')->firstOrFail();
    $buyer = User::where('email', 'buyer1@tiketku.test')->firstOrFail();

    expect(User::count())->toBe(6)
        ->and($admin->hasRole('admin'))->toBeTrue()
        ->and($admin->hasVerifiedEmail())->toBeTrue()
        ->and($buyer->hasRole('buyer'))->toBeTrue()
        ->and($buyer->hasVerifiedEmail())->toBeTrue();

    $this->app->detectEnvironment(fn (): string => 'testing');

    $this->post(route('login.store'), [
        'email' => 'buyer1@tiketku.test',
        'password' => 'TiketKuDemo2026!',
    ])->assertRedirect(route('home'));

    $this->assertAuthenticatedAs($buyer);
});

it('does not seed demo accounts outside the local environment', function () {
    $this->app->detectEnvironment(fn (): string => 'testing');

    $this->seed(DatabaseSeeder::class);

    expect(User::query()->count())->toBe(0);
});
