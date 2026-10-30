<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;

it('authenticates a user and logs them out', function () {
    $user = User::factory()->create([
        'email' => 'buyer@example.test',
        'password' => 'Ticketku!2026',
    ]);

    $this->post(route('login.store'), [
        'email' => 'buyer@example.test',
        'password' => 'Ticketku!2026',
    ])->assertRedirect(route('profile.edit'));

    $this->assertAuthenticatedAs($user);

    $this->post(route('logout'))->assertRedirect('/');

    $this->assertGuest();
});

it('rejects incorrect credentials', function () {
    User::factory()->create([
        'email' => 'buyer@example.test',
        'password' => 'Ticketku!2026',
    ]);

    $this->from(route('login'))->post(route('login.store'), [
        'email' => 'buyer@example.test',
        'password' => 'wrong-password',
    ])->assertSessionHasErrors('email');

    expect(Auth::check())->toBeFalse();
});

it('limits repeated login attempts', function () {
    User::factory()->create(['email' => 'buyer@example.test']);

    for ($attempt = 0; $attempt < 5; $attempt++) {
        $this->post(route('login.store'), [
            'email' => 'buyer@example.test',
            'password' => 'wrong-password',
        ])->assertRedirect();
    }

    $this->post(route('login.store'), [
        'email' => 'buyer@example.test',
        'password' => 'wrong-password',
    ])->assertTooManyRequests();
});

it('renders the registration and login forms', function () {
    $this->get(route('register'))
        ->assertOk()
        ->assertSee('Buat akun')
        ->assertSee('name="phone"', false);

    $this->get(route('login'))
        ->assertOk()
        ->assertSee('Masuk')
        ->assertSee('name="remember"', false);
});
