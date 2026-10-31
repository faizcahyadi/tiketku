@extends('layouts.app')

@section('title', 'Temukan event berikutnya')

@section('content')
    <section class="home-placeholder" aria-labelledby="home-heading">
        <div class="home-copy">
            <p class="site-eyebrow">Momen berikutnya dimulai di sini</p>
            <h1 id="home-heading">Temukan momen <span class="text-accent">berikutnya.</span></h1>
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

    <section class="home-statement" aria-labelledby="home-statement-heading">
        <p class="section-index">01</p>
        <div>
            <p class="site-eyebrow">Pernyataan · Arah produk</p>
            <h2 id="home-statement-heading">Setiap momen besar dimulai dari <span class="text-accent">tiket yang jelas.</span></h2>
            <p>TiketKu dirancang untuk menyatukan pencarian event, alur pembelian, dan akses masuk dalam satu perjalanan.</p>
            <a class="text-link" href="{{ route('events.index') }}">Jelajahi contoh event</a>
        </div>
        <p class="statement-mark" aria-hidden="true">TK</p>
    </section>

    <section class="home-story" aria-labelledby="home-story-heading">
        <div class="section-heading">
            <div>
                <p class="site-eyebrow">Dibangun bertahap</p>
                <h2 id="home-story-heading">Rencana <span class="text-accent">pengembangan.</span></h2>
            </div>
            <p class="preview-note">Rencana ini bukan daftar fitur yang sudah tersedia.</p>
        </div>
        <ol class="home-timeline">
            <li><strong>01 · Akun</strong><span>Masuk dan kelola profil</span></li>
            <li><strong>02 · Event</strong><span>Temukan acara dan kategori tiket</span></li>
            <li><strong>03 · Pembelian</strong><span>Checkout dan pembayaran</span></li>
            <li><strong>04 · Hari acara</strong><span>Tiket digital dan pemindaian</span></li>
        </ol>
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

    <section class="home-countdown" aria-labelledby="home-countdown-heading">
        <div>
            <p class="site-eyebrow">Jadwal contoh berikutnya · Preview</p>
            <h2 id="home-countdown-heading">{{ $featuredEvent['title'] }}</h2>
            <p>{{ $featuredEvent['date'] }} · {{ $featuredEvent['venue'] }}, {{ $featuredEvent['city'] }} · {{ $featuredEvent['time'] }}</p>
        </div>
        <a class="button-primary" href="{{ route('events.show', $featuredEvent['slug']) }}">Lihat detail event</a>
    </section>

    <section class="home-lineup" aria-labelledby="home-lineup-heading">
        <p class="home-wordmark" aria-hidden="true">TIKETKU</p>
        <div class="section-heading">
            <div>
                <p class="site-eyebrow">Pilih suasananya</p>
                <h2 id="home-lineup-heading">Kategori <span class="text-accent">contoh.</span></h2>
            </div>
            <p class="preview-note">Line-up artis belum tersedia di preview ini.</p>
        </div>
        <ul class="genre-tags" aria-label="Kategori event contoh">
            @foreach (collect($events)->pluck('genre')->unique() as $genre)
                <li>{{ $genre }}</li>
            @endforeach
        </ul>
    </section>

    <section class="home-spotlight" aria-labelledby="home-spotlight-heading">
        <div class="section-heading">
            <div>
                <p class="site-eyebrow">Lanjutkan eksplorasi</p>
                <h2 id="home-spotlight-heading">Pilihan <span class="text-accent">untuk dijelajahi.</span></h2>
            </div>
        </div>
        <div class="spotlight-list">
            @foreach ($events as $event)
                <article class="spotlight-card">
                    <p class="site-eyebrow">{{ $event['genre'] }} · {{ $event['city'] }}</p>
                    <h3>{{ $event['title'] }}</h3>
                    <p>{{ $event['summary'] }}</p>
                    <a class="text-link" href="{{ route('events.show', $event['slug']) }}">Lihat event</a>
                </article>
            @endforeach
        </div>
    </section>

    <section class="home-principles" aria-labelledby="home-principles-heading">
        <p class="section-index">08</p>
        <div>
            <p class="site-eyebrow">Prinsip produk · Arah pengembangan</p>
            <h2 id="home-principles-heading">Pengalaman yang <span class="text-accent">terencana.</span></h2>
        </div>
        <ul>
            <li><strong>Alur yang jelas</strong><span>Dari menemukan event sampai memahami langkah berikutnya.</span></li>
            <li><strong>Informasi konsisten</strong><span>Jadwal, lokasi, dan kategori tampil berdampingan.</span></li>
            <li><strong>Akses yang tertata</strong><span>Peran penyelenggara dan panitia disiapkan sesuai tugasnya.</span></li>
        </ul>
    </section>
@endsection
