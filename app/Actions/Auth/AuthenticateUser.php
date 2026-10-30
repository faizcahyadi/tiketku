<?php

namespace App\Actions\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;

class AuthenticateUser
{
    /**
     * Attempt to authenticate with the submitted credentials.
     *
     * @param  array{email: string, password: string, remember?: bool}  $credentials
     */
    public function __invoke(Request $request, array $credentials): ?bool
    {
        $remember = (bool) ($credentials['remember'] ?? false);
        unset($credentials['remember']);
        $throttleKey = 'login|'.Str::lower($credentials['email']).'|'.$request->ip();

        if (RateLimiter::tooManyAttempts($throttleKey, 5)) {
            return null;
        }

        if (Auth::attempt($credentials, $remember)) {
            RateLimiter::clear($throttleKey);

            return true;
        }

        RateLimiter::hit($throttleKey, 60);

        return false;
    }
}
