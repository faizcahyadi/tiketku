@extends('layouts.app')

@section('title', 'Checkout contoh')

@section('content')
    <section class="page-heading">
        <p class="site-eyebrow">Langkah sebelum tiket</p>
        <h1>Checkout <span class="text-accent">contoh.</span></h1>
        <p>Ini tampilan preview dengan data contoh. Belum ada pesanan atau pembayaran yang dibuat.</p>
    </section>

    <section class="checkout-preview" aria-label="Ringkasan checkout contoh">
        <article class="checkout-event-card">
            <span class="sample-label">Contoh data</span>
            <p class="site-eyebrow">{{ $event['date'] }} · {{ $event['city'] }}</p>
            <h2>{{ $event['title'] }}</h2>
            <p>{{ $event['venue'] }} · {{ $event['time'] }}</p>
        </article>
        <dl class="checkout-summary">
            <div><dt>Kategori</dt><dd>{{ $ticketType['name'] }}</dd></div>
            <div><dt>Jumlah</dt><dd>{{ $quantity }} tiket</dd></div>
            <div><dt>Harga tiket contoh</dt><dd>Rp{{ number_format($ticketType['price'], 0, ',', '.') }}</dd></div>
            <div class="checkout-total"><dt>Total contoh</dt><dd>Rp{{ number_format($total, 0, ',', '.') }}</dd></div>
            <p class="preview-note">Total ini hanya contoh dan tidak disimpan sebagai pesanan.</p>
            <a class="button-primary" href="{{ route('tickets.preview') }}">Lihat e-ticket contoh</a>
            <a class="text-link" href="{{ route('events.show', $event['slug']) }}">Kembali ke detail event</a>
        </dl>
    </section>
@endsection
