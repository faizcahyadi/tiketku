<?php

namespace App\Http\Controllers\Auth;

use App\Actions\Auth\AuthenticateUser;
use App\Actions\Auth\LogoutUser;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    public function create(): View
    {
        return view('auth.login');
    }

    public function store(LoginRequest $request, AuthenticateUser $authenticateUser): RedirectResponse
    {
        $authenticated = $authenticateUser($request, $request->validated());

        if ($authenticated === null) {
            $response = back()->withErrors([
                'email' => 'Terlalu banyak percobaan masuk. Coba lagi sebentar.',
            ])->onlyInput('email');
            $response->setStatusCode(429);

            return $response;
        }

        if (! $authenticated) {
            return back()->withErrors([
                'email' => 'Email atau kata sandi tidak cocok.',
            ])->onlyInput('email');
        }

        $request->session()->regenerate();

        return redirect()->intended(route('profile.edit'));
    }

    public function destroy(Request $request, LogoutUser $logoutUser): RedirectResponse
    {
        $logoutUser($request);

        return redirect('/');
    }
}
