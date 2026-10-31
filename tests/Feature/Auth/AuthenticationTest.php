<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;

function loginRateLimitKeyForTest(string $email, string $ip = '127.0.0.1'): string
{
    return 'login|'.hash('sha256', Str::lower($email).'|'.$ip);
}

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

it('stores login attempts under a bounded key for long valid email addresses', function () {
    $email = str_repeat('a', 64).'@'.str_repeat('b', 63).'.'.str_repeat('c', 62).'.'.str_repeat('d', 25).'.com';
    $key = loginRateLimitKeyForTest($email);
    RateLimiter::clear($key);

    $this->post(route('login.store'), [
        'email' => $email,
        'password' => 'wrong-password',
    ])->assertSessionHasErrors('email');

    expect(strlen($key))->toBeLessThan(80)
        ->and(RateLimiter::attempts($key))->toBe(1);
});

it('rejects login email addresses longer than 255 characters', function () {
    $email = str_repeat('a', 64).'@'.str_repeat('b', 63).'.'.str_repeat('c', 63).'.'.str_repeat('d', 63);

    $this->post(route('login.store'), [
        'email' => $email,
        'password' => 'wrong-password',
    ])->assertSessionHasErrors('email');
});

it('limits repeated login attempts', function () {
    $email = 'buyer@example.test';
    User::factory()->create(['email' => $email]);
    RateLimiter::clear(loginRateLimitKeyForTest($email));

    for ($attempt = 0; $attempt < 5; $attempt++) {
        $this->post(route('login.store'), [
            'email' => $email,
            'password' => 'wrong-password',
        ])->assertRedirect();
    }

    $this->post(route('login.store'), [
        'email' => $email,
        'password' => 'wrong-password',
    ])->assertTooManyRequests()
        ->assertHeader('Retry-After')
        ->assertSee('Terlalu banyak percobaan masuk');
});

it('isolates failed login attempts by email address', function () {
    User::factory()->create(['email' => 'first@example.test']);
    User::factory()->create(['email' => 'second@example.test']);
    RateLimiter::clear(loginRateLimitKeyForTest('first@example.test'));
    RateLimiter::clear(loginRateLimitKeyForTest('second@example.test'));

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
    RateLimiter::clear(loginRateLimitKeyForTest($email));

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
