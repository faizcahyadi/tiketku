<?php

namespace App\Http\Controllers\Auth;

use App\Actions\Auth\ResendVerificationNotification;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class EmailVerificationNotificationController extends Controller
{
    public function __invoke(Request $request, ResendVerificationNotification $resendVerificationNotification): RedirectResponse
    {
        $sent = $resendVerificationNotification($request->user());

        $message = $sent
            ? 'Tautan verifikasi sudah dikirim ulang.'
            : 'Alamat email Anda sudah terverifikasi.';

        return back()->with('status', $message);
    }
}
