<?php

use App\Models\User;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\URL;

it('verifies an email with a valid signed link', function () {
    $user = User::factory()->unverified()->create();
    $verificationUrl = URL::temporarySignedRoute(
        'verification.verify',
        now()->addMinutes(60),
        ['id' => $user->id, 'hash' => sha1($user->email)],
    );

    $this->actingAs($user)->get($verificationUrl)
        ->assertRedirect(route('profile.edit'));

    expect($user->fresh()->hasVerifiedEmail())->toBeTrue();
});

it('resends a verification notification to the signed-in user', function () {
    $user = User::factory()->unverified()->create();
    Notification::fake();

    $this->actingAs($user)->post(route('verification.send'))
        ->assertRedirect();

    Notification::assertSentTo($user, VerifyEmail::class);
});

it('rejects an email verification link with an invalid signature', function () {
    $user = User::factory()->unverified()->create();

    $this->actingAs($user)->get('/email/verify/'.$user->id.'/'.sha1($user->email))
        ->assertForbidden();

    expect($user->fresh()->hasVerifiedEmail())->toBeFalse();
});

it('shows the verification notice to an unverified user', function () {
    $user = User::factory()->unverified()->create(['email' => 'verify@example.test']);

    $this->actingAs($user)->get(route('verification.notice'))
        ->assertOk()
        ->assertSee('verify@example.test')
        ->assertSee(route('verification.send'), false);
});
