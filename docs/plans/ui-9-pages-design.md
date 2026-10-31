# Rancangan: 9 halaman tampilan awal TiketKu

Tanggal: 31 Oktober 2026

## Tujuan

Menyediakan sembilan halaman Blade yang bisa dijelajahi sebagai satu produk TiketKu. Semua halaman memakai layout utama, navigasi yang saling terhubung, dan design token dari `docs/DESIGN.md`. Konten event dan transaksi menggunakan data contoh.

## Halaman dan rute

| Halaman | Rute usulan | Isi utama |
|---|---|---|
| Beranda | `/` | Event pilihan, event terbaru, CTA ke katalog |
| Katalog event | `/events` | Daftar event contoh dan kontrol pencarian/filter tampilan |
| Detail event | `/events/{slug}` | Info event, kategori tiket contoh, CTA ke checkout |
| Masuk | `/login` | Form autentikasi yang sudah ada, dengan tampilan konsisten |
| Daftar | `/register` | Form pendaftaran yang sudah ada, dengan tampilan konsisten |
| Checkout | `/checkout/demo` | Ringkasan pesanan dan form contoh tanpa membuat order atau pembayaran |
| Pesanan & e-ticket | `/my-tickets` | Daftar pesanan contoh dan tampilan tiket/QR ilustratif |
| Dashboard organizer | `/organizer` | Ringkasan penjualan dan event menggunakan angka contoh |
| Scanner panitia | `/scanner` | Tampilan scanner dan contoh hasil validasi; tidak mengakses kamera atau check-in sungguhan |

Halaman login dan daftar mempertahankan alur auth yang telah ada di branch ini. Halaman lain hanya menyajikan tampilan dengan data contoh dan tidak menulis transaksi ke database.

## Struktur tampilan

- Satu layout utama Blade untuk header, navigasi, area konten, dan footer.
- Navigasi menghubungkan halaman publik, akun, dashboard, dan scanner; tautan aktif diberi penanda visual.
- Partial/component Blade untuk elemen berulang seperti kartu event, badge status, tombol, dan ringkasan angka.
- Token warna, tipografi, radius, dan jarak hanya bersumber dari `docs/DESIGN.md` dan `resources/css/app.css`.
- Bahasa antarmuka Bahasa Indonesia; tidak menambahkan logo, foto, testimoni, atau statistik faktual baru.

## Batas cakupan

- Tidak menambah dependency.
- Tidak membuat/mengubah skema database, role, policy, payment, order, QR bertanda tangan, kamera scanner, atau integrasi real-time.
- Kontrol yang tidak punya perilaku dalam cakupan hanya ditampilkan sebagai teks/informasi; tautan navigasi harus menuju halaman yang tersedia.
- Tidak membuat alur organizer atau scanner terlihat seolah-olah sudah melakukan otorisasi/check-in nyata.

## Kriteria penerimaan

- Kesembilan rute dapat dibuka dan memiliki judul/isi yang sesuai.
- Navigasi utama berfungsi di antara halaman yang disediakan dan menandai halaman aktif.
- Semua halaman berbagi layout dan style token, dengan layout responsif pada 375, 768, dan 1280 piksel.
- Form yang sudah berfungsi tetap mempertahankan validasi dan perilaku auth yang ada.
- Halaman tampilan contoh tidak mengubah database.
- Test Pest mencakup render halaman, tautan/rute, dan perilaku auth yang disentuh; build CSS berhasil.
- Setelah kesembilan halaman selesai, tersedia user manual dan panduan demo yang mengikuti perilaku aplikasi yang benar-benar ada.
- Panduan demo membedakan alur yang sungguh berfungsi dari halaman preview yang memakai data contoh.

## Keputusan yang disetujui

1. Sembilan halaman dan rute usulan di atas disetujui.
2. Halaman organizer dan scanner tampil sebagai preview dengan data contoh, tanpa fungsi transaksi atau check-in.
3. Branch/PR UI dipisahkan dari branch auth.
4. Migration dan model Laravel tetap menjadi hasil yang wajib ada di tahap backend; bagian UI ini tidak menambahkan skema baru.

## Materi setelah halaman selesai

- `docs/USER-MANUAL.md`: cara membuka dan memakai tiap halaman, langkah akun buyer, serta batas fitur preview.
- `docs/DEMO-GUIDE.md`: persiapan demo lokal, urutan presentasi sembilan halaman, akun/data yang dibutuhkan, dan penjelasan fitur yang belum terhubung ke database.
- Isi kedua dokumen diverifikasi terhadap route, seeder, dan alur yang benar-benar tersedia setelah implementasi; jangan mencantumkan login demo atau transaksi palsu sebagai fitur nyata.
