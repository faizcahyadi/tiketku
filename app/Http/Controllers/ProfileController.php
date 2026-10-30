<?php

namespace App\Http\Controllers;

use App\Actions\Auth\UpdateUserProfile;
use App\Http\Requests\Auth\UpdateProfileRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    public function update(UpdateProfileRequest $request, UpdateUserProfile $updateUserProfile): RedirectResponse
    {
        $emailChanged = $updateUserProfile($request->user(), $request->validated());

        return redirect()->route('profile.edit')->with(
            'status',
            $emailChanged
                ? 'Profil tersimpan. Periksa email baru untuk memverifikasi alamat tersebut.'
                : 'Profil tersimpan.'
        );
    }
}
