<?php

namespace App\Actions\Auth;

use App\Models\User;

class ResendVerificationNotification
{
    public function __invoke(User $user): bool
    {
        if ($user->hasVerifiedEmail()) {
            return false;
        }

        $user->sendEmailVerificationNotification();

        return true;
    }
}
