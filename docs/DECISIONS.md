# Catatan Keputusan Teknis (ADR ringkas)

Format: konteks -> keputusan -> alasan. Status: Proposed / Accepted / Superseded.
Ubah statusnya sendiri setelah lo setuju.

## 001 — Framework & UI: Laravel 12 + Livewire
**Status:** Proposed
Satu bahasa (PHP) untuk backend dan UI interaktif, cocok untuk dashboard dan seat map (dengan Alpine/JS secukupnya).
Alternatif: Inertia + Vue/React kalau mau frontend terpisah.

## 002 — Environment: Laragon (Windows), tanpa Docker
**Status:** Accepted
Dev environment lokal pakai Laragon (PHP 8.3, MySQL, Composer) di Windows, tanpa Docker/WSL.
Alasan: setup paling simpel buat pengembang tunggal di Windows.
Konsekuensi: Redis perlu diaktifkan manual di Laragon saat masuk Tahap 8 (kursi dan antrean).
Perintah npm dijalankan dari PowerShell (Node 24), bukan terminal Laragon (Node 18).

## 003 — Uang sebagai integer Rupiah
**Status:** Proposed
Hindari float. Semua harga/total disimpan sebagai bilangan bulat Rupiah.

## 004 — Logic bisnis di Action class
**Status:** Proposed
Controller/Livewire tipis, logic di `app/Actions/<Domain>`. Memudahkan test dan membatasi area yang diubah agent.

## 005 — Pencegahan oversell: DB transaction + lock, Redis untuk hold sementara
**Status:** Proposed
DB adalah sumber kebenaran. Redis (TTL) dipakai untuk reservasi sementara dan kecepatan.
Wajib ada test paralel yang membuktikan tidak ada oversell.

## 006 — Pembayaran: gateway sandbox + webhook idempotent
**Status:** Proposed (gateway belum dipilih: Midtrans / Xendit)
Order jadi `paid` hanya lewat webhook terverifikasi. Tabel `webhook_events` mencegah pemrosesan ganda.

## 007 — QR tiket bertanda tangan (HMAC)
**Status:** Proposed
Kode acak + signature supaya tidak bisa ditebak. Validasi check-in atomic (update bersyarat `status = issued`).

## 008 — Real-time: Laravel Reverb
**Status:** Proposed (dikerjakan di Tahap 8)
Untuk status kursi dan dashboard penjualan live.

## 009 — Role & permission: spatie/laravel-permission + Policy
**Status:** Proposed

## 010 — Kualitas: Pest + Pint + Larastan + GitHub Actions
**Status:** Proposed
CI harus hijau sebelum merge ke `main`.

---
## Log pelajaran (diisi seiring jalan)
- (contoh) Agent sering lupa eager loading di listing -> aturan ditambah di AGENTS.md.
