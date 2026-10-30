<?php

use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Database\Seeders\RoleSeeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Role;

it('creates the user phone, permission, and activity log tables', function () {
    expect(Schema::hasColumn('users', 'phone'))->toBeTrue()
        ->and(Schema::hasTable('roles'))->toBeTrue()
        ->and(Schema::hasTable('permissions'))->toBeTrue()
        ->and(Schema::hasTable('model_has_roles'))->toBeTrue()
        ->and(Schema::hasTable('activity_log'))->toBeTrue();
});

it('seeds global roles idempotently without permissions', function () {
    $this->seed(RoleSeeder::class);
    $this->seed(RoleSeeder::class);

    expect(Role::query()->orderBy('name')->pluck('name')->all())
        ->toBe(['admin', 'buyer', 'gate_staff', 'organizer'])
        ->and(DB::table('permissions')->count())->toBe(0);
});

it('supports assigning a global role to a user', function () {
    $this->seed(RoleSeeder::class);
    $user = User::factory()->create();

    $user->assignRole('buyer');

    expect($user->hasRole('buyer'))->toBeTrue();
});

it('creates users with nullable phone numbers and an unverified factory state', function () {
    $user = User::factory()->unverified()->create();

    expect($user->phone)->toBeNull()
        ->and($user->email_verified_at)->toBeNull();
});

it('seeds roles without demo accounts outside the local environment', function () {
    $this->seed(DatabaseSeeder::class);

    expect(Role::query()->count())->toBe(4)
        ->and(User::query()->count())->toBe(0);
});
