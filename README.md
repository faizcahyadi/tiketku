# TiketKu

TiketKu adalah prototype platform tiket event multi-organizer. Repository ini memuat fondasi akun dan role serta sembilan halaman preview untuk alur pembeli dan operasional acara.

## Status saat ini

Sudah tersedia:

- Registrasi, login, verifikasi email, dan pengelolaan profil.
- Role global `admin`, `organizer`, `gate_staff`, dan `buyer`.
- Katalog event contoh, detail event, checkout preview, dan e-ticket contoh.
- Preview dashboard organizer dan halaman scanner panitia.
- Layout, navigasi, dan tampilan responsif yang dipakai bersama.

> Event, harga, pesanan, tiket, dan angka dashboard pada halaman preview adalah data contoh. Checkout tidak membuat pembayaran atau pesanan, QR tidak berlaku untuk check-in, dan halaman organizer serta scanner belum menjadi panel operasional. Migration untuk event, order, pembayaran, tiket, dan check-in belum tersedia.

## Teknologi

- Laravel 13.17 dan PHP 8.3
- MySQL
- Blade, Tailwind CSS, dan Vite
- Spatie Laravel Permission dan Activitylog
- Pest, Pint, dan Larastan

## Menjalankan secara lokal

Contoh berikut memakai PowerShell dan Laragon di Windows. Pastikan MySQL Laragon berjalan, serta PHP 8.3, Composer, dan Node.js 24 tersedia.

```powershell
git clone https://github.com/faizcahyadi/tiketku.git
cd tiketku
composer install
Copy-Item .env.example .env
```

Edit `.env` sebelum menjalankan migration. Gunakan database MySQL lokal yang kamu siapkan:

```dotenv
APP_NAME=TiketKu
APP_ENV=local
APP_DEBUG=true
APP_URL=http://127.0.0.1:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=tiketku
DB_USERNAME=root
DB_PASSWORD=

MAIL_MAILER=log
```

Sesuaikan username dan password database dengan pengaturan Laragon. Lalu jalankan:

```powershell
php artisan key:generate
php artisan migrate --seed
npm ci
npm run build
php artisan serve --host=127.0.0.1 --port=8000
```

Buka <http://127.0.0.1:8000>. Setelah mengganti branch atau mengambil perubahan UI, jalankan `npm run build` lagi agar stylesheet terbaru tersedia. Jangan memakai `php artisan migrate:fresh` pada database yang berisi data karena perintah itu menghapus tabel.

## Akun demo lokal

Seeder membuat akun demo hanya ketika `APP_ENV=local`. Semua akun berikut memakai kata sandi `TiketKuDemo2026!`:

| Role | Email |
| --- | --- |
| Admin | `admin@tiketku.test` |
| Buyer | `buyer1@tiketku.test` sampai `buyer5@tiketku.test` |

Akun demo sudah terverifikasi. Gunakan hanya untuk pengembangan lokal, bukan server publik. Halaman organizer dan scanner masih preview dan belum memakai hak akses operasional.

## Halaman preview

1. Beranda
2. Katalog event
3. Detail event
4. Masuk
5. Daftar
6. Checkout preview
7. Pesanan dan e-ticket
8. Dashboard organizer
9. Scanner panitia

Dokumen project:

- [Manual Pengguna](docs/USER-MANUAL.md)
- [Panduan Demo Lokal](docs/DEMO-GUIDE.md)
- [PRD](docs/PRD.md)
- [Skema Database](docs/DATABASE.md)
- [Panduan Desain](docs/DESIGN.md)
- [Catatan Keputusan](docs/DECISIONS.md)

## Pemeriksaan proyek

Jalankan dari PowerShell pada folder project:

```powershell
php artisan test
.\vendor\bin\pint --test
composer analyse
```
