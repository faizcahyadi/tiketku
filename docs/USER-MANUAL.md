# Panduan Pengguna TiketKu

Panduan ini menjelaskan sembilan halaman utama yang tersedia saat ini. Konten event, harga, angka dashboard, dan tiket pada halaman preview adalah data contoh.

## Menjelajahi halaman

- **Beranda (`/`)** — lihat event pilihan dan tautan menuju katalog.
- **Katalog event (`/events`)** — cari nama event atau venue, lalu filter berdasarkan kota dan kategori. Pilih nama event untuk membuka detail.
- **Detail event (`/events/{slug}`)** — lihat tanggal, lokasi, ringkasan, dan kategori tiket contoh.
- **Masuk (`/login`)** — masuk menggunakan akun TiketKu.
- **Daftar (`/register`)** — buat akun buyer. Email verifikasi dikirim menggunakan konfigurasi aplikasi.
- **Checkout preview (`/checkout/demo`)** — lihat contoh ringkasan harga dan jumlah tiket.
- **Pesanan & e-ticket (`/my-tickets`)** — lihat contoh tampilan tiket dan area placeholder QR.
- **Dashboard organizer (`/organizer`)** — lihat contoh ringkasan penjualan organizer.
- **Scanner panitia (`/scanner`)** — lihat rancangan halaman scanner.

Gunakan navigasi di bagian atas atau tautan di footer untuk berpindah halaman. Di layar sempit, tekan ikon menu untuk membuka navigasi. Tautan yang sedang dibuka mendapat penanda aktif.

## Akun buyer

1. Jalankan migration terbaru dengan `php artisan migrate --seed` dari folder project. Ini menambahkan kolom `phone` dan tabel auth yang dibutuhkan tanpa menghapus data yang sudah ada. Jangan gunakan `migrate:fresh` pada database yang ingin dipertahankan.
2. Untuk demo lokal, jalankan `php artisan db:seed` pada `APP_ENV=local`. Akun siap pakai:

   - Admin: `admin@tiketku.test`
   - Buyer: `buyer1@tiketku.test` sampai `buyer5@tiketku.test`
   - Kata sandi semua akun: `TiketKuDemo2026!`

   Akun demo lokal sudah terverifikasi. Jangan pakai kata sandi demo di server selain lokal.
3. Untuk daftar akun baru, buka **Daftar** dan isi nama, email yang belum terpakai, serta kata sandi pilihan Anda. Nomor telepon boleh dikosongkan.
4. Setelah pendaftaran, akun langsung masuk dan aplikasi menampilkan halaman verifikasi email. Dengan `MAIL_MAILER=log`, tautan verifikasi tercatat di `storage/logs/laravel.log`.
5. Untuk login berikutnya, gunakan email dan kata sandi yang dipilih saat mendaftar. Setelah masuk, buka **Akun saya** untuk mengubah nama, email, atau nomor telepon.
6. Keluar dari akun melalui tombol **Keluar** di navigasi.

Rute verifikasi email dan profil merupakan layar pendukung akun yang sudah tersedia di luar sembilan halaman utama.

## Batas preview

- Katalog memakai event contoh yang disediakan aplikasi; filter hanya mencari data contoh tersebut.
- Checkout tidak membuat order atau pembayaran.
- Kode tiket dan placeholder QR tidak berlaku untuk masuk venue.
- Dashboard berisi angka contoh, bukan hasil penjualan atau data real-time.
- Halaman scanner belum meminta akses kamera dan tidak memvalidasi atau menandai tiket.
- Halaman dashboard dan scanner saat ini adalah preview tampilan, bukan panel dengan otorisasi operasional.

Migration, model, dan alur auth yang sudah tersedia tetap menyimpan akun dan role di Laravel. Halaman event, order, ticket, dan check-in masih menunggu tahap backend masing-masing.
