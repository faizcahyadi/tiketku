@extends('layouts.auth')

@section('title', 'Buat akun')
@section('eyebrow', 'Mulai di TiketKu')
@section('heading', 'Buat akun')
@section('intro', 'Daftar untuk mencari event dan menyimpan tiket Anda.')

@section('content')
    <form class="auth-form" method="POST" action="{{ route('register.store') }}">
        @csrf
        <div class="field">
            <label for="name">Nama</label>
            <input id="name" name="name" type="text" value="{{ old('name') }}" autocomplete="name" required autofocus>
            @error('name') <span class="field-error">{{ $message }}</span> @enderror
        </div>
        <div class="field">
            <label for="email">Email</label>
            <input id="email" name="email" type="email" value="{{ old('email') }}" autocomplete="email" required>
            @error('email') <span class="field-error">{{ $message }}</span> @enderror
        </div>
        <div class="field">
            <label for="phone">Nomor telepon <span>(opsional)</span></label>
            <input id="phone" name="phone" type="tel" value="{{ old('phone') }}" autocomplete="tel" maxlength="32">
            @error('phone') <span class="field-error">{{ $message }}</span> @enderror
        </div>
        <div class="field">
            <label for="password">Kata sandi</label>
            <input id="password" name="password" type="password" autocomplete="new-password" required>
            @error('password') <span class="field-error">{{ $message }}</span> @enderror
        </div>
        <div class="field">
            <label for="password_confirmation">Ulangi kata sandi</label>
            <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" required>
        </div>
        <button class="submit" type="submit">Buat akun</button>
    </form>
    <p class="auth-links">Sudah punya akun? <a href="{{ route('login') }}">Masuk</a></p>
@endsection
