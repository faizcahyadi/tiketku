# Panduan Demo TiketKu

Panduan ini menjalankan aplikasi secara lokal dan menunjukkan sembilan halaman utama tanpa mengklaim transaksi contoh sebagai data nyata.

## Persiapan lokal

1. Jalankan MySQL melalui Laragon dan siapkan database `tiketku`.
2. Gunakan PowerShell dengan PHP 8.3, Composer, dan Node.js 24 tersedia di `PATH`.
3. Jika `.env` belum ada, salin `.env.example` menjadi `.env`. Atur `APP_URL`, lalu pastikan `DB_CONNECTION`, `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, dan `DB_PASSWORD` sesuai MySQL Laragon. Gunakan `MAIL_MAILER=log` untuk demo verifikasi email lokal.
4. Jalankan `composer setup`. Perintah ini memasang dependency yang terkunci, membuat application key, menjalankan migration serta seeder role, lalu memasang dependency frontend dan membuat build CSS.
5. Jalankan `php artisan serve --host=127.0.0.1 --port=8000`, lalu buka <http://127.0.0.1:8000>.

> Catatan: build menggunakan font Instrument Sans yang sudah diatur project dan perlu koneksi internet saat aset font belum tersedia di cache.

## Urutan demo halaman

1. **Beranda** — tunjukkan event pilihan dan menu utama.
2. **Katalog** — cari `Ruang`, lalu coba filter kota `Bandung` atau kategori `Olahraga`.
3. **Detail event** — buka salah satu kartu untuk menampilkan jadwal, lokasi, dan harga contoh.
4. **Checkout preview** — tunjukkan ringkasan, lalu jelaskan bahwa tidak ada order atau pembayaran yang disimpan.
5. **Pesanan & e-ticket** — tunjukkan kartu tiket dan placeholder QR yang tidak dapat dipakai untuk check-in.
6. **Dashboard organizer** — jelaskan bahwa angka penjualan ditandai sebagai contoh dan belum berasal dari database.
7. **Scanner panitia** — tunjukkan area scanner preview; kamera tidak dibuka dan tidak ada tiket yang diverifikasi.
8. **Masuk dan daftar** — jika ingin menunjukkan auth, daftarkan email lokal yang belum dipakai. Buka `storage/logs/laravel.log` untuk menemukan tautan verifikasi saat `MAIL_MAILER=log`.

Semua halaman dapat dibuka dari navigasi utama atau footer. Untuk menghentikan server lokal, tekan `Ctrl+C` pada terminal yang menjalankannya.

## Akun dan data demo

Branch ini tidak menyediakan akun admin, organizer, atau panitia demo. Seeder yang tersedia menyiapkan role global; akun buyer dapat dibuat melalui halaman daftar. Dashboard dan scanner adalah halaman preview terbuka, bukan area operasional yang sudah dilindungi policy.

Event, kategori tiket, angka dashboard, kode tiket, dan status yang terlihat pada halaman contoh tidak dibuat sebagai record database. Jangan gunakan data tersebut sebagai bukti pembayaran atau check-in.

## Setelah demo

Sebelum demo di mesin lain, jalankan ulang migration/seeder sesuai `.env` lokal dan pastikan build tersedia. Jangan memasukkan kredensial atau secret ke dokumen ini atau ke repository.
