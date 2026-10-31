# TiketKu — Platform Event & Ticketing

Platform penjualan tiket event/konser multi-organizer. Baca `docs/PRD.md`,
`docs/DATABASE.md`, dan `docs/DECISIONS.md` sebelum mengerjakan task apa pun.

## Stack
Laravel 13, PHP 8.3, MySQL, Livewire, Pest, Pint, Larastan.
Redis baru dipakai mulai Tahap 8 (kursi dan antrean), jangan dipakai sebelum diminta.
Dev environment: Laragon (Windows), tanpa Docker/Sail.

## Perintah wajib sebelum menyatakan task selesai
- `php artisan test`        -> semua test harus hijau
- `./vendor/bin/pint`       -> format kode
- `composer analyse`        -> phpstan, tanpa error baru

## Catatan environment
- Perintah PHP/Composer/artisan dijalankan dari terminal Laragon.
- Perintah npm (`npm install`, `npm run build`, `npm run dev`) dijalankan dari PowerShell dengan Node 24 (terminal Laragon memakai Node 18 dan akan error).

## Aturan arsitektur
- Business logic ada di Action class (`app/Actions/<Domain>/`), BUKAN di controller/Livewire component.
- Controller/Livewire tipis: validasi (FormRequest) -> panggil Action -> return/render.
- Status order, payment, ticket, seat pakai PHP backed enum + transisi eksplisit.
- Uang disimpan sebagai integer Rupiah (tanpa desimal). Jangan pakai float.
- Hindari N+1: pakai eager loading, cek dengan `Model::preventLazyLoading()` di non-production.
- Tidak ada raw query tanpa parameter binding.
- Otorisasi lewat Policy + Spatie permission. Jangan cek role manual di view/controller.

## Aturan keamanan & uang (PALING PENTING)
- Webhook pembayaran HARUS idempotent: cek `webhook_events` dan status order sebelum memproses.
- Perubahan stok/kursi HARUS di dalam DB transaction + lock (`lockForUpdate()` atau `Cache::lock`).
- Jangan pernah percaya harga/total dari request. Hitung ulang di server dari `ticket_categories`.
- QR tiket ditandatangani (HMAC), validasi check-in harus atomic.
- Jangan commit secret. Semua kunci lewat `.env`.

## Aturan kerja
- Kerjakan HANYA yang diminta di task. Jangan refactor file lain.
- Setiap fitur baru wajib ada test Pest (happy path + edge case).
- Kalau ada keputusan desain yang ambigu, tanya dulu. Jangan menebak.
- Jangan install package baru tanpa izin; sebutkan alasannya kalau butuh.
- Jangan ubah migration yang sudah di-merge; buat migration baru.
- Di akhir task, tulis ringkasan: file yang diubah, asumsi yang diambil, hal yang perlu direview manusia.
- Untuk task UI, baca docs/DESIGN.md dan gambar di docs/design/ dulu. Ikuti token dan gaya di sana.

## Konvensi
- Nama tabel/kolom: snake_case, bahasa Inggris. Teks UI: bahasa Indonesia.
- Commit message: conventional commits (`feat:`, `fix:`, `test:`, `docs:`, `refactor:`).
- 1 task = 1 branch = 1 PR kecil.

## Catatan environment
- Semua perintah dijalankan dari PowerShell (Windows). PHP, Composer, dan Node 24 harus ada di PATH.
- MySQL berjalan lewat Laragon (harus dalam keadaan Start All), database: `tiketku`.
- Jangan jalankan `npm run dev` atau server panjang lain kecuali diminta.
