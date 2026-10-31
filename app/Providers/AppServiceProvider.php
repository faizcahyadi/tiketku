<?php

namespace App\Providers;

use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        VerifyEmail::toMailUsing(function (object $notifiable, string $url): MailMessage {
            return (new MailMessage)
                ->subject('Verifikasi alamat email Anda')
                ->greeting('Halo!')
                ->line('Klik tombol di bawah untuk memverifikasi alamat email akun TiketKu Anda.')
                ->action('Verifikasi alamat email', $url)
                ->line('Jika Anda tidak membuat akun TiketKu, Anda dapat mengabaikan email ini.');
        });
    }
}
