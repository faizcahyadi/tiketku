<?php

namespace App\Actions\Auth;

use App\Models\User;
use Illuminate\Support\Facades\DB;

class RegisterUser
{
    /**
     * Create a buyer account and send its verification notification.
     *
     * @param  array{name: string, email: string, phone?: ?string, password: string}  $attributes
     */
    public function __invoke(array $attributes): User
    {
        $user = DB::transaction(function () use ($attributes): User {
            $user = User::create($attributes);
            $user->assignRole('buyer');

            return $user;
        });

        $user->sendEmailVerificationNotification();

        return $user;
    }
}
