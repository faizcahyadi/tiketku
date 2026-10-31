@extends('layouts.app')

@section('title', 'Preview scanner panitia')

@section('content')
    <section class="page-heading">
        <p class="site-eyebrow">Akses panitia · preview</p>
        <h1>Scanner <span class="text-accent">panitia.</span></h1>
        <p>Tampilan ini belum mengakses kamera dan belum melakukan check-in.</p>
    </section>

    <section class="scanner-preview" aria-labelledby="scanner-preview-heading">
        <div class="scanner-frame" aria-hidden="true">
            <span class="scanner-corner scanner-corner-top-left"></span>
            <span class="scanner-corner scanner-corner-top-right"></span>
            <span class="scanner-corner scanner-corner-bottom-left"></span>
            <span class="scanner-corner scanner-corner-bottom-right"></span>
            <span class="scanner-placeholder-mark">QR</span>
        </div>
        <div class="scanner-copy">
            <span class="sample-label">Preview saja</span>
            <h2 id="scanner-preview-heading">Kamera tidak diakses</h2>
            <p>Validasi tiket akan tersedia setelah scanner terhubung ke QR bertanda tangan dan data check-in.</p>
            <div class="scanner-result" role="status">
                <p class="site-eyebrow">Hasil contoh</p>
                <strong>Belum ada tiket yang diverifikasi</strong>
                <span>QR contoh tidak dapat digunakan untuk check-in.</span>
            </div>
        </div>
    </section>
@endsection
