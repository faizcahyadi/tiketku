@extends('layouts.app')

@section('title', 'Temukan event berikutnya')

@section('content')
    <section class="home-placeholder">
        <div class="home-copy">
            <p class="site-eyebrow">Momen berikutnya dimulai di sini</p>
            <h1>Temukan momen <span class="text-accent">berikutnya.</span></h1>
            <p>Jelajahi konser, pertunjukan, dan pengalaman yang layak masuk kalender Anda.</p>
            <div class="hero-actions">
                <a class="button-primary" href="{{ route('events.index') }}">Lihat semua event</a>
                <a class="button-secondary" href="{{ route('events.show', $featuredEvent['slug']) }}">Event pilihan</a>
            </div>
        </div>
        <aside class="featured-event" aria-labelledby="featured-event-title">
            <span class="sample-label">Event berikutnya · Contoh data</span>
            <p class="featured-event-mark" aria-hidden="true">LIVE</p>
            <p class="featured-event-meta">{{ $featuredEvent['date'] }} · {{ $featuredEvent['city'] }}</p>
            <h2 id="featured-event-title">{{ $featuredEvent['title'] }}</h2>
            <p>{{ $featuredEvent['venue'] }} · {{ $featuredEvent['time'] }}</p>
            <a href="{{ route('events.show', $featuredEvent['slug']) }}">Lihat detail event</a>
        </aside>
    </section>
    <section class="home-latest" aria-labelledby="latest-events-heading">
        <div class="section-heading">
            <div>
                <p class="site-eyebrow">Pilih tujuan Anda</p>
                <h2 id="latest-events-heading">Event <span class="text-accent">mendatang.</span></h2>
            </div>
            <a class="text-link" href="{{ route('events.index') }}">Semua event</a>
        </div>
        <div class="event-list">
            @foreach ($events as $index => $event)
                <x-event-card :event="$event" :index="$index + 1" />
            @endforeach
        </div>
    </section>
@endsection
