@extends('layouts.app')

@section('content')
    <div class="auth-shell">
        <div class="auth-wrap">
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
                @yield('form-content')
            </section>
        </div>
    </div>
@endsection
