<!doctype html>
<html lang="id">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="description" content="Temukan event berikutnya bersama TiketKu.">
        <title>@yield('title', 'Temukan event berikutnya') · TiketKu</title>
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @endif
    </head>
    <body class="site-body">
        <a class="skip-link" href="#main-content">Lewati ke konten</a>
        <header class="site-header">
            <div class="site-header-inner">
                <a class="site-brand" href="{{ route('home') }}" aria-label="TiketKu, beranda">
                    <span>TiketKu</span>
                    <span class="site-brand-caption">Event &amp; tiket</span>
                </a>
                <x-navigation />
            </div>
        </header>
        <main id="main-content" class="site-main">
            @yield('content')
        </main>
        <x-footer />
    </body>
</html>
