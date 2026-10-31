@extends('layouts.auth')

@section('title', 'Coba lagi nanti')
@section('eyebrow', 'Keamanan akun')
@section('heading', 'Coba lagi nanti')
@section('intro', 'Terlalu banyak percobaan masuk. Tunggu sebentar sebelum mencoba kembali.')

@section('form-content')
    <p class="auth-links" role="status">Anda bisa mencoba lagi dalam {{ $retryAfter }} detik.</p>
    <a class="button-primary" href="{{ route('login') }}">Kembali ke halaman masuk</a>
@endsection
