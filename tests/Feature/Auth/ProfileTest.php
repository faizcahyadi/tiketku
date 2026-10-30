<?php

use App\Models\User;

it('allows an authenticated user to update their profile', function () {
    $user = User::factory()->create();

    $this->actingAs($user)->put(route('profile.update'), [
        'name' => 'Ayu Baru',
        'email' => $user->email,
        'phone' => '081298765432',
    ])->assertRedirect(route('profile.edit'));

    expect($user->fresh()->name)->toBe('Ayu Baru')
        ->and($user->fresh()->phone)->toBe('081298765432');
});

it('requires re-verification when the user changes their email', function () {
    $user = User::factory()->create(['email' => 'old@example.test']);

    $this->actingAs($user)->put(route('profile.update'), [
        'name' => $user->name,
        'email' => 'new@example.test',
        'phone' => null,
    ])->assertRedirect(route('profile.edit'));

    expect($user->fresh()->email)->toBe('new@example.test')
        ->and($user->fresh()->email_verified_at)->toBeNull();
});

it('rejects profile access for guests', function () {
    $this->get(route('profile.edit'))->assertRedirect(route('login'));
});

it('rejects an email address that belongs to another account', function () {
    $user = User::factory()->create();
    User::factory()->create(['email' => 'taken@example.test']);

    $this->actingAs($user)->put(route('profile.update'), [
        'name' => $user->name,
        'email' => 'taken@example.test',
        'phone' => null,
    ])->assertSessionHasErrors('email');
});

it('renders an authenticated user profile form', function () {
    $user = User::factory()->create();

    $this->actingAs($user)->get(route('profile.edit'))
        ->assertOk()
        ->assertSee('name="phone"', false)
        ->assertSee('Simpan profil');
});
