<!doctype html>
<html lang="id">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('title') · TiketKu</title>
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @endif
    </head>
    <body>
        <main class="auth-shell">
            <div class="auth-wrap">
                <a class="brand" href="/" aria-label="TiketKu, beranda">TiketKu</a>
                <section class="auth-panel" aria-labelledby="auth-title">
                    <p class="auth-eyebrow">@yield('eyebrow', 'Akun TiketKu')</p>
                    <h1 id="auth-title">@yield('heading')</h1>
                    <p class="auth-intro">@yield('intro')</p>
                    @if ($errors->any())
                        <div class="form-error" role="alert">Periksa kembali data yang Anda masukkan.</div>
                    @endif
                    @if (session('status'))
                        <p class="status" role="status">{{ session('status') }}</p>
                    @endif
                    @yield('content')
                </section>
            </div>
        </main>
    </body>
</html>
