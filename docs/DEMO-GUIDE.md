# Panduan Demo TiketKu

Panduan ini menjalankan aplikasi secara lokal dan menunjukkan sembilan halaman utama tanpa mengklaim transaksi contoh sebagai data nyata.

## Persiapan lokal

1. Jalankan MySQL melalui Laragon dan siapkan database `tiketku`.
2. Gunakan PowerShell dengan PHP 8.3, Composer, dan Node.js 24 tersedia di `PATH`.
3. Jika `.env` belum ada, salin `.env.example` menjadi `.env`. Atur `APP_URL`, lalu pastikan `DB_CONNECTION`, `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, dan `DB_PASSWORD` sesuai MySQL Laragon. Gunakan `MAIL_MAILER=log` untuk demo verifikasi email lokal.
4. Untuk project yang sudah terpasang, jalankan `php artisan migrate --seed` agar migration `phone`, Spatie, dan activity log diterapkan. Untuk setup baru, `composer setup` juga memasang dependency dari lockfile, membuat application key, menjalankan migration serta seeder role, dan membuat build CSS. Jangan jalankan `migrate:fresh` pada database yang berisi data.
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
8. **Masuk dan daftar** — jalankan `php artisan db:seed` di environment lokal untuk akun demo. Admin: `admin@tiketku.test`; buyer: `buyer1@tiketku.test` sampai `buyer5@tiketku.test`; kata sandi: `TiketKuDemo2026!`. Atau buat akun baru melalui **Daftar** menggunakan email yang belum dipakai dan kata sandi pilihan Anda. Pendaftaran langsung memasukkan akun ke sesi dan mengarahkan ke halaman verifikasi. Tautan email `MAIL_MAILER=log` tercatat di `storage/logs/laravel.log`.

Semua halaman dapat dibuka dari navigasi utama atau footer. Untuk menghentikan server lokal, tekan `Ctrl+C` pada terminal yang menjalankannya.

## Akun dan data demo

Seeder lokal membuat satu akun admin dan lima akun buyer yang sudah terverifikasi. Seeder tidak membuat akun organizer atau panitia karena model keanggotaan organizer belum tersedia pada tahap ini. Dashboard dan scanner adalah halaman preview terbuka, bukan area operasional yang sudah dilindungi policy.

Event, kategori tiket, angka dashboard, kode tiket, dan status yang terlihat pada halaman contoh tidak dibuat sebagai record database. Jangan gunakan data tersebut sebagai bukti pembayaran atau check-in.

## Setelah demo

Sebelum demo di mesin lain, jalankan ulang migration/seeder sesuai `.env` lokal dan pastikan build tersedia. Jangan memasukkan kredensial atau secret ke dokumen ini atau ke repository.
