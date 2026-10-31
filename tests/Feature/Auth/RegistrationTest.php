<?php

use App\Models\User;
use Database\Seeders\RoleSeeder;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Support\Facades\Notification;

it('registers a buyer and sends an email verification notification', function () {
    $this->seed(RoleSeeder::class);
    Notification::fake();

    $this->post(route('register.store'), [
        'name' => 'Ayu Pembeli',
        'email' => 'ayu@example.test',
        'phone' => '081234567890',
        'password' => 'Ticketku!2026',
        'password_confirmation' => 'Ticketku!2026',
    ])->assertRedirect(route('verification.notice'));

    $user = User::where('email', 'ayu@example.test')->firstOrFail();
    $this->assertAuthenticatedAs($user);

    expect($user->phone)->toBe('081234567890')
        ->and($user->hasRole('buyer'))->toBeTrue()
        ->and($user->hasVerifiedEmail())->toBeFalse();

    Notification::assertSentTo($user, VerifyEmail::class);
    Notification::assertSentTo($user, VerifyEmail::class, function (VerifyEmail $notification) use ($user) {
        $mail = $notification->toMail($user);

        return $mail->subject === 'Verifikasi alamat email Anda'
            && $mail->actionText === 'Verifikasi alamat email';
    });
});

it('rejects a duplicate email during registration', function () {
    $this->seed(RoleSeeder::class);
    User::factory()->create(['email' => 'ayu@example.test']);

    $this->from(route('register'))->post(route('register.store'), [
        'name' => 'Ayu Pembeli',
        'email' => 'ayu@example.test',
        'password' => 'Ticketku!2026',
        'password_confirmation' => 'Ticketku!2026',
    ])->assertSessionHasErrors('email');
});

it('registers a buyer without a phone number and allows that account to log in', function () {
    $this->seed(RoleSeeder::class);
    Notification::fake();

    $this->post(route('register.store'), [
        'name' => 'Budi Pembeli',
        'email' => 'budi@example.test',
        'password' => 'Ticketku!2026',
        'password_confirmation' => 'Ticketku!2026',
    ])->assertRedirect(route('verification.notice'));

    $this->assertAuthenticated();
    $this->post(route('logout'))->assertRedirect('/');

    $this->post(route('login.store'), [
        'email' => 'budi@example.test',
        'password' => 'Ticketku!2026',
    ])->assertRedirect(route('profile.edit'));

    $this->assertAuthenticatedAs(User::where('email', 'budi@example.test')->firstOrFail());
});
