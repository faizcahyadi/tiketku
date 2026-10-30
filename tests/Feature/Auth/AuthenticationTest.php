<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;

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
    $email = 'buyer@example.test';
    User::factory()->create(['email' => $email]);
    RateLimiter::clear('login|'.$email.'|127.0.0.1');

    for ($attempt = 0; $attempt < 5; $attempt++) {
        $this->post(route('login.store'), [
            'email' => $email,
            'password' => 'wrong-password',
        ])->assertRedirect();
    }

    $this->post(route('login.store'), [
        'email' => $email,
        'password' => 'wrong-password',
    ])->assertTooManyRequests();
});

it('isolates failed login attempts by email address', function () {
    User::factory()->create(['email' => 'first@example.test']);
    User::factory()->create(['email' => 'second@example.test']);
    RateLimiter::clear('login|first@example.test|127.0.0.1');
    RateLimiter::clear('login|second@example.test|127.0.0.1');

    for ($attempt = 0; $attempt < 5; $attempt++) {
        $this->post(route('login.store'), [
            'email' => 'first@example.test',
            'password' => 'wrong-password',
        ])->assertRedirect();
    }

    $this->post(route('login.store'), [
        'email' => 'first@example.test',
        'password' => 'wrong-password',
    ])->assertTooManyRequests();

    $this->post(route('login.store'), [
        'email' => 'second@example.test',
        'password' => 'wrong-password',
    ])->assertRedirect();
});

it('clears failed login attempts after a successful login', function () {
    $email = 'buyer@example.test';
    User::factory()->create([
        'email' => $email,
        'password' => 'Ticketku!2026',
    ]);
    RateLimiter::clear('login|'.$email.'|127.0.0.1');

    for ($attempt = 0; $attempt < 4; $attempt++) {
        $this->post(route('login.store'), [
            'email' => $email,
            'password' => 'wrong-password',
        ])->assertRedirect();
    }

    $this->post(route('login.store'), [
        'email' => $email,
        'password' => 'Ticketku!2026',
    ])->assertRedirect(route('profile.edit'));
    $this->post(route('logout'))->assertRedirect('/');

    for ($attempt = 0; $attempt < 5; $attempt++) {
        $this->post(route('login.store'), [
            'email' => $email,
            'password' => 'wrong-password',
        ])->assertRedirect();
    }

    $this->post(route('login.store'), [
        'email' => $email,
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
