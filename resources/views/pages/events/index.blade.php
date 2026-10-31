@extends('layouts.app')

@section('title', 'Katalog event')

@section('content')
    <section class="page-heading">
        <p class="site-eyebrow">Pilihan untuk agenda Anda</p>
        <h1>Katalog <span class="text-accent">event.</span></h1>
        <p>Jelajahi acara yang akan datang. Daftar di halaman ini adalah data contoh.</p>
    </section>

    <form class="event-filters" method="GET" action="{{ route('events.index') }}" aria-label="Cari dan filter event">
        <div class="field">
            <label for="event-search">Cari event atau venue</label>
            <input id="event-search" name="q" type="search" value="{{ $filters['q'] ?? '' }}" placeholder="Contoh: Ruang Nada">
        </div>
        <div class="field">
            <label for="event-city">Kota</label>
            <select id="event-city" name="city">
                <option value="">Semua kota</option>
                @foreach (collect($allEvents)->pluck('city')->unique() as $city)
                    <option value="{{ $city }}" @selected(($filters['city'] ?? '') === $city)>{{ $city }}</option>
                @endforeach
            </select>
        </div>
        <div class="field">
            <label for="event-genre">Kategori</label>
            <select id="event-genre" name="genre">
                <option value="">Semua kategori</option>
                @foreach (collect($allEvents)->pluck('genre')->unique() as $genre)
                    <option value="{{ $genre }}" @selected(($filters['genre'] ?? '') === $genre)>{{ $genre }}</option>
                @endforeach
            </select>
        </div>
        <button class="button-primary" type="submit">Terapkan filter</button>
        @if (($filters['q'] ?? '') !== '' || ($filters['city'] ?? '') !== '' || ($filters['genre'] ?? '') !== '')
            <a class="filter-reset" href="{{ route('events.index') }}">Hapus filter</a>
        @endif
    </form>

    <section class="event-list" aria-label="Daftar event contoh">
        @forelse ($events as $index => $event)
            <x-event-card :event="$event" :index="$index + 1" />
        @empty
            <p class="empty-state">Belum ada event contoh yang cocok dengan filter ini.</p>
        @endforelse
    </section>
@endsection
