@extends('layouts.app')

@section('title', 'Dashboard organizer')

@section('content')
    <section class="page-heading">
        <p class="site-eyebrow">Ruang penyelenggara · preview</p>
        <h1>Dashboard <span class="text-accent">organizer.</span></h1>
        <p>Angka dan daftar di halaman ini adalah data contoh, bukan transaksi.</p>
    </section>

    <section class="organizer-preview" aria-labelledby="organizer-summary-heading">
        <div class="section-heading">
            <div>
                <p class="site-eyebrow">Preview saja</p>
                <h2 id="organizer-summary-heading">Ringkasan penjualan contoh</h2>
            </div>
            <span class="sample-label">Contoh data</span>
        </div>
        <div class="organizer-metrics">
            @foreach ($metrics as $metric)
                <article class="organizer-metric">
                    <p>{{ $metric['label'] }}</p>
                    <strong>{{ $metric['value'] }}</strong>
                </article>
            @endforeach
        </div>
        <p class="preview-note">Angka ini bukan data transaksi dan tidak diperbarui secara real-time.</p>
        <section class="organizer-event-preview" aria-label="Event contoh organizer">
            <div>
                <p class="site-eyebrow">Event contoh</p>
                <h3>{{ $event['title'] }}</h3>
                <p>{{ $event['date'] }} · {{ $event['venue'] }}</p>
            </div>
            <span class="sample-status">Status: contoh</span>
        </section>
    </section>
@endsection
