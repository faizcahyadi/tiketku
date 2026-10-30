# PRD — TiketKu

## 1. Ringkasan
TiketKu adalah platform multi-organizer untuk menjual tiket event dan konser.
Organizer membuat event dan mengatur tiket, pembeli membeli dan menerima e-ticket
ber-QR, panitia memvalidasi tiket di pintu masuk lewat browser HP.

Nilai pembeda proyek: penanganan rebutan tiket/kursi (concurrency), seat map
real-time, dan antrean virtual untuk event populer.

## 2. Tujuan
- Penjualan tiket tanpa oversell, walaupun banyak pembeli bersamaan.
- Alur pembayaran yang andal (idempotent, status jelas).
- Check-in cepat dan anti tiket ganda/palsu.
- Dashboard organizer dengan data penjualan real-time.

## 3. Non-goals (di luar scope)
- Pembayaran uang sungguhan (hanya sandbox payment gateway).
- Aplikasi mobile native.
- Pembayaran internasional, multi mata uang.
- Marketplace resale tiket (hanya transfer sederhana, tahap akhir).

## 4. Peran pengguna
| Peran | Kemampuan utama |
|---|---|
| Admin | Verifikasi organizer, atur komisi, lihat laporan global, moderasi event |
| Organizer (owner/manager) | Buat dan kelola event, kategori tiket, promo, lihat penjualan, kelola panitia |
| Gate staff | Scan QR di pintu masuk untuk event organizer-nya |
| Buyer | Cari event, beli tiket, lihat e-ticket, riwayat pesanan |

## 5. Alur utama
1. Organizer mendaftar, admin memverifikasi.
2. Organizer membuat event (draft), kategori tiket, lalu publish.
3. Buyer memilih tiket (atau kursi), checkout, order `pending` dengan batas waktu bayar.
4. Buyer membayar lewat gateway. Webhook mengubah order menjadi `paid`.
5. Sistem menerbitkan tiket ber-QR (PDF + halaman tiket).
6. Hari-H: gate staff scan QR, tiket berubah `used`, tercatat di `checkins`.

## 6. Status (state machine)
**Order:** `pending -> paid -> (refunded)` ; `pending -> expired | cancelled`
**Payment:** `pending -> paid | failed | expired` ; `paid -> refunded`
**Ticket:** `issued -> used | cancelled | refunded`
**Seat:** `available -> held -> sold` ; `held -> available` (kedaluwarsa/batal)
**Event:** `draft -> published -> finished | cancelled`

## 7. Kebutuhan fungsional per tahap

### Tahap 1 — Fondasi
- [ ] Auth (register, login, verifikasi email), profil
- [ ] Role & permission (admin, organizer, gate_staff, buyer)
- [ ] Migration inti + factory + seeder demo

### Tahap 2 — Event & tiket (organizer)
- [ ] Pendaftaran organizer + verifikasi admin
- [ ] CRUD event (draft/publish), upload banner
- [ ] CRUD kategori tiket (harga, kuota, periode jual)

### Tahap 3 — Katalog publik
- [ ] Daftar event, filter (kota, tanggal, kategori, harga), pencarian
- [ ] Halaman detail event

### Tahap 4 — Order & checkout (tanpa kursi)
- [ ] Pilih jumlah tiket per kategori, batas maksimal per order
- [ ] Order `pending` dengan `expires_at`, kuota ditahan aman
- [ ] Kode promo (persen/nominal)
- [ ] Job pembersih order kedaluwarsa

### Tahap 5 — Pembayaran
- [ ] Integrasi payment gateway sandbox
- [ ] Webhook idempotent + tabel `webhook_events`
- [ ] Order jadi `paid` hanya lewat webhook terverifikasi

### Tahap 6 — E-ticket
- [ ] Generate tiket + kode unik + QR bertanda tangan
- [ ] Halaman tiket + unduh PDF + kirim email

### Tahap 7 — Check-in
- [ ] Halaman scanner (kamera browser) untuk gate staff
- [ ] Validasi atomic, tolak duplikat/palsu, counter live

### Tahap 8 — Seat map & real-time
- [ ] Layout kursi per event (section/baris/nomor)
- [ ] Reservasi kursi (Redis TTL + DB lock), status real-time lewat WebSocket
- [ ] Dashboard penjualan organizer real-time

### Tahap 9 — Bonus
- [ ] Antrean virtual untuk event populer
- [ ] Load test (k6) dan laporan hasil
- [ ] Refund dan transfer tiket
- [ ] Koleksi badge tiket digital

## 8. Kebutuhan non-fungsional
- **Integritas:** tidak boleh ada oversell kuota/kursi (dibuktikan dengan test paralel).
- **Keamanan:** otorisasi berbasis Policy, validasi server-side, rate limiting login/checkout, CSRF, tanpa secret di repo.
- **Keandalan:** webhook idempotent, job queue dengan retry, log aktivitas untuk aksi penting.
- **Performa:** halaman katalog < 500 ms pada data demo (ribuan event), tanpa N+1.
- **Kualitas:** test Pest untuk semua Action kritis, CI hijau sebelum merge.

## 9. Kriteria selesai (Definition of Done) per fitur
- Test Pest lolos (happy path + edge case)
- Pint dan PHPStan bersih
- Diff sudah direview manusia
- Docs diperbarui kalau ada keputusan baru
