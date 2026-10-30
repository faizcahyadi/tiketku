@extends('layouts.auth')

@section('title', 'Masuk')
@section('eyebrow', 'Selamat datang kembali')
@section('heading', 'Masuk')
@section('intro', 'Masuk untuk melihat profil dan tiket Anda.')

@section('content')
    <form class="auth-form" method="POST" action="{{ route('login.store') }}">
        @csrf
        <div class="field">
            <label for="email">Email</label>
            <input id="email" name="email" type="email" value="{{ old('email') }}" autocomplete="email" required autofocus>
            @error('email') <span class="field-error">{{ $message }}</span> @enderror
        </div>
        <div class="field">
            <label for="password">Kata sandi</label>
            <input id="password" name="password" type="password" autocomplete="current-password" required>
            @error('password') <span class="field-error">{{ $message }}</span> @enderror
        </div>
        <label class="remember" for="remember">
            <input id="remember" name="remember" type="checkbox" value="1">
            <span>Ingat saya</span>
        </label>
        <button class="submit" type="submit">Masuk</button>
    </form>
    <p class="auth-links">Belum punya akun? <a href="{{ route('register') }}">Daftar</a></p>
@endsection
