@extends('layouts.auth')

@section('title', 'Profil')
@section('eyebrow', 'Akun Anda')
@section('heading', 'Profil')
@section('intro', 'Perbarui nama, email, dan nomor telepon yang terhubung ke akun.')

@section('content')
    <form class="auth-form" method="POST" action="{{ route('profile.update') }}">
        @csrf
        @method('PUT')
        <div class="field">
            <label for="name">Nama</label>
            <input id="name" name="name" type="text" value="{{ old('name', $user->name) }}" autocomplete="name" required>
            @error('name') <span class="field-error">{{ $message }}</span> @enderror
        </div>
        <div class="field">
            <label for="email">Email</label>
            <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" autocomplete="email" required>
            @error('email') <span class="field-error">{{ $message }}</span> @enderror
        </div>
        <div class="field">
            <label for="phone">Nomor telepon <span>(opsional)</span></label>
            <input id="phone" name="phone" type="tel" value="{{ old('phone', $user->phone) }}" autocomplete="tel" maxlength="32">
            @error('phone') <span class="field-error">{{ $message }}</span> @enderror
        </div>
        <button class="submit" type="submit">Simpan profil</button>
    </form>
    @unless ($user->hasVerifiedEmail())
        <p class="auth-links"><a href="{{ route('verification.notice') }}">Verifikasi email</a></p>
    @endunless
    <form class="auth-form logout-form" method="POST" action="{{ route('logout') }}">
        @csrf
        <button class="submit" type="submit">Keluar</button>
    </form>
@endsection
