<?php

namespace App\Actions\Auth;

use App\Models\User;

class UpdateUserProfile
{
    /**
     * Update profile details and clear verification if the email changed.
     *
     * @param  array{name: string, email: string, phone?: ?string}  $attributes
     */
    public function __invoke(User $user, array $attributes): bool
    {
        $emailChanged = $user->email !== $attributes['email'];

        $user->fill($attributes);

        if ($emailChanged) {
            $user->email_verified_at = null;
        }

        $user->save();

        return $emailChanged;
    }
}
