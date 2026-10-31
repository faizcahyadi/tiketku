@extends('layouts.app')

@section('title', $event['title'])

@section('content')
    <article class="event-detail">
        <div class="event-detail-art">
            <span class="sample-label">Contoh data</span>
            <p class="event-detail-art-mark" aria-hidden="true">{{ $event['genre'] }}</p>
        </div>
        <div class="event-detail-copy">
            <p class="site-eyebrow">{{ $event['genre'] }} · {{ $event['city'] }}</p>
            <h1>{{ $event['title'] }}</h1>
            <p class="event-detail-summary">{{ $event['summary'] }}</p>
            <dl class="event-facts">
                <div><dt>Tanggal</dt><dd>{{ $event['date'] }}</dd></div>
                <div><dt>Waktu</dt><dd>{{ $event['time'] }}</dd></div>
                <div><dt>Lokasi</dt><dd>{{ $event['venue'] }}, {{ $event['city'] }}</dd></div>
            </dl>
            <section class="ticket-options" aria-labelledby="ticket-options-heading">
                <h2 id="ticket-options-heading">Kategori tiket contoh</h2>
                @foreach ($event['ticket_types'] as $ticketType)
                    <div class="ticket-option">
                        <span>{{ $ticketType['name'] }}</span>
                        <strong>Rp{{ number_format($ticketType['price'], 0, ',', '.') }}</strong>
                    </div>
                @endforeach
                <p class="preview-note">Harga dan kategori di atas hanya untuk preview.</p>
            </section>
            <a class="button-primary" href="{{ route('checkout.demo') }}">Lanjut ke preview checkout</a>
        </div>
    </article>
@endsection
