<?php

namespace App\Actions\Auth;

use Illuminate\Support\Facades\Auth;

class AuthenticateUser
{
    /**
     * Attempt to authenticate with the submitted credentials.
     *
     * @param  array{email: string, password: string, remember?: bool}  $credentials
     */
    public function __invoke(array $credentials): bool
    {
        $remember = (bool) ($credentials['remember'] ?? false);
        unset($credentials['remember']);

        return Auth::attempt($credentials, $remember);
    }
}
