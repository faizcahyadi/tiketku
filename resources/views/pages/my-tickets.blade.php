@extends('layouts.app')

@section('title', 'Pesanan dan e-ticket')

@section('content')
    <section class="page-heading">
        <p class="site-eyebrow">Simpan momen Anda</p>
        <h1>Pesanan &amp; <span class="text-accent">e-ticket.</span></h1>
        <p>Berikut tampilan tiket contoh. Tidak ada transaksi nyata yang tercatat.</p>
    </section>

    <article class="demo-e-ticket">
        <div class="demo-ticket-main">
            <span class="sample-label">Tiket contoh</span>
            <p class="site-eyebrow">{{ $event['date'] }} · {{ $event['city'] }}</p>
            <h2>{{ $event['title'] }}</h2>
            <p>{{ $event['venue'] }} · {{ $event['time'] }}</p>
            <dl class="ticket-facts">
                <div><dt>Status contoh</dt><dd>Preview saja</dd></div>
                <div><dt>Kode contoh</dt><dd>{{ $ticketCode }}</dd></div>
            </dl>
        </div>
        <div class="qr-placeholder" role="img" aria-label="QR contoh, tidak dapat digunakan untuk check-in">
            <span>QR contoh</span>
            <small>Tidak berlaku untuk check-in</small>
        </div>
    </article>
    <p class="preview-note">Untuk membeli tiket sungguhan, pesanan dan pembayaran perlu dihubungkan ke database dan payment gateway.</p>
    <a class="button-secondary" href="{{ route('events.index') }}">Kembali ke katalog</a>
@endsection
