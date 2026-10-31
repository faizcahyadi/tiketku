@extends('layouts.auth')

@section('title', 'Verifikasi email')
@section('eyebrow', 'Satu langkah lagi')
@section('heading', 'Verifikasi email')
@section('intro', 'Tautan verifikasi dikirim ke alamat berikut:')

@section('content')
    <div class="auth-form">
        <p><strong>{{ $email }}</strong></p>
        <p>Buka email tersebut untuk mengaktifkan akun Anda. Jika tautannya tidak terlihat, periksa folder spam atau kirim ulang.</p>
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button class="submit" type="submit">Kirim ulang tautan</button>
        </form>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="submit" type="submit">Keluar</button>
        </form>
    </div>
@endsection
