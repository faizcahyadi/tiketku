# Panduan Desain — TiketKu

Referensi visual: `docs/design/reference-home.png` (landing page tim basket bergaya
bold/atletis: latar hitam, aksen oranye, huruf condensed raksasa, bentuk miring).
Ambil **gaya dan struktur**-nya saja. Jangan menyalin logo, nama tim, foto, atau
ilustrasi dari referensi. Pakai aset sendiri atau aset berlisensi bebas.

> Nilai warna adalah estimasi dari gambar. Verifikasi dengan color picker
> (mis. PowerToys Color Picker, `Win+Shift+C`) bila perlu, lalu ubah di token.

## 1. Arah visual
- Mood: berani, energik, sinematik, seperti poster pertandingan.
- Dark only (tanpa light mode untuk saat ini).
- Judul raksasa berhuruf kapital, font condensed tebal, line-height rapat.
- Warna dominan hitam; **oranye** sebagai aksen utama; **kuning amber** hanya untuk lencana kecil miring.
- Foto dramatis dengan kabut/debu dan cahaya oranye, latar gelap.
- Kata raksasa samar di belakang konten (mis. "1996", "LIVE", "OUR TEAM") sebagai tekstur.
- Satu kata raksasa oranye terpotong di dasar halaman (wordmark footer).

## 2. Motif khas (wajib konsisten)
1. **Bentuk miring (skew).** Label nama, lencana skor, dan tag memakai jajaran genjang
   dengan `skew-x` sekitar -10deg. Teks di dalamnya dimiringkan balik agar tegak.
2. **Lencana angka miring.** Kotak kecil kuning amber, agak berputar (sekitar -8deg),
   berisi nomor section (`01`, `04`) atau teks pendek ("COMING SOON"), diletakkan menempel di dekat judul.
3. **Kartu dengan offset oranye.** Baris/kartu berborder terang tipis dengan garis oranye
   tebal di sisi bawah dan kanan (efek bayangan keras tanpa blur).
4. **Kata kunci beraksen.** Satu kata di judul diwarnai oranye ("... BUILT TO **ENDURE**").
5. **Angka dan garis waktu.** Garis putus-putus horizontal dengan tahun di bawahnya.

## 3. Design tokens

### Warna
| Token | Nilai (estimasi) | Dipakai untuk |
|---|---|---|
| `--color-bg` | `#0A0A0A` | Latar halaman |
| `--color-bg-warm` | `#140C07` | Latar hero/overlay hangat |
| `--color-surface` | `#141414` | Kartu, panel |
| `--color-surface-2` | `#1D1D1D` | Hover kartu, input |
| `--color-border` | `#2E2E2E` | Garis pemisah |
| `--color-border-strong` | `#F2EDE4` | Border terang kartu offset |
| `--color-text` | `#FFFFFF` | Teks utama |
| `--color-text-muted` | `#A6A6A6` | Teks pendukung |
| `--color-accent` | `#FF6A00` | Tombol utama, angka, kata beraksen |
| `--color-accent-hover` | `#FF8426` | Hover tombol utama |
| `--color-accent-ink` | `#0A0A0A` | Teks di atas latar oranye |
| `--color-badge` | `#F5B301` | Lencana kuning miring |
| `--color-success` | `#22C55E` | Lunas, tiket valid |
| `--color-danger` | `#EF4444` | Error, tiket ditolak |

Aturan: oranye maksimal sekitar 10-15% area layar; kuning amber hanya untuk lencana kecil.
Glow: `radial-gradient(circle at 70% 30%, rgba(255,106,0,.35), transparent 60%)`.
Teks judul hero boleh memakai gradasi putih ke abu perak (kesan metalik).

### Tipografi
- **Display:** font condensed tebal, huruf kapital. Pilihan: `Anton`, `Bebas Neue`, atau `Oswald` (Google Fonts). Default: **Anton**.
- **Body:** `Inter` atau sans-serif bersih sejenis.
- Heading: UPPERCASE (lewat CSS), line-height 0.95-1.05.
- Eyebrow/label kecil: 11-12px, UPPERCASE, letter-spacing +0.12em.

| Level | Ukuran |
|---|---|
| Wordmark raksasa | `clamp(5rem, 20vw, 18rem)` |
| H1 (hero) | `clamp(3.5rem, 10vw, 8rem)` |
| H2 (judul section) | `clamp(2.25rem, 5vw, 4rem)` |
| H3 (judul kartu) | 1.25-1.75rem |
| Skor/angka besar | `clamp(1.75rem, 3vw, 2.5rem)` |
| Timer countdown | `clamp(3rem, 8vw, 6rem)` |
| Body | 1rem, line-height 1.6 |
| Caption | 0.75rem |

### Spacing, bentuk, efek
- Spacing kelipatan 4px. Jarak antar section: 96-128px desktop, 64px mobile.
- Radius kecil dan tegas (0-6px). Tombol hampir kotak.
- Skew: `--skew: -10deg`.
- Offset kartu: `box-shadow: 4px 4px 0 var(--color-accent)` (tanpa blur).
- Transisi 150-250ms. Hover kartu: naik 2px, offset oranye membesar.

## 4. Layout
- Lebar konten maksimal `1280px`, padding samping 24px (mobile) / 48px (desktop).
- Desain **mobile dulu**. Breakpoint 640 / 768 / 1024 / 1280.
- Navbar: menu kiri, logo di tengah, menu kanan (desktop). Mobile: logo kiri + menu hamburger.
  Transparan di atas hero, solid saat scroll.

## 5. Komponen

**Tombol**
- Primary: latar oranye, teks gelap, UPPERCASE, tebal, sudut hampir kotak.
- Secondary: transparan, border putih, teks putih.
- Ukuran sm/md/lg. State: hover, focus (ring oranye), disabled, loading.

**Baris event** (pengganti baris pertandingan "Latest Battles")
- Satu baris per event dalam kartu offset oranye.
- Isi: tanggal kecil di atas (hari, kota, venue), poster kecil + nama event di kiri,
  **lencana harga miring berwarna oranye** di tengah, kategori/artis di kanan, aksi "Beli Tiket".
- Judul section di kiri dengan lencana angka kuning dan label oranye di bawahnya ("EVENT TERBARU").

**Countdown** ("Countdown to Glory")
- Lencana kuning miring di atas ("SEGERA"), judul besar, timer `JJ : MM : DD` raksasa di tengah,
  poster/logo di kiri dan kanan, info tanggal/venue/jam kecil di bawah timer, tombol "Beli Tiket".
- Kata raksasa samar di belakang (mis. "LIVE").

**Tag nama miring** (dari bagian tim)
- Jajaran genjang putih, teks hitam: nomor kecil + NAMA. Dipakai untuk label artis/line-up
  di bawah foto.

**Kartu sorotan (Spotlight)**
- Layout horizontal: gambar di kiri, teks di kanan (judul oranye UPPERCASE, deskripsi pendek, tombol kecil oranye).
- Carousel dua kartu per layar di desktop, satu di mobile; panah bulat oranye di bawah.

**Statistik (Legacy)**
- Angka oranye raksasa + label putih kecil di bawah (event, tahun berdiri, total tiket terjual).
- Lencana kuning miring "01" dan latar foto arena yang digelapkan.

**Garis waktu**
- Garis putus-putus horizontal, tahun di bawahnya, tahun aktif lebih terang.

**Badge status**
- Pill kecil UPPERCASE: `Tersedia`, `Hampir Habis`, `Sold Out`, `Lunas`, `Menunggu Pembayaran`, `Kedaluwarsa`.

**Form**
- Input latar `--color-surface-2`, border `--color-border`, fokus: border oranye.
  Contoh bagian newsletter: input gelap + tombol oranye "GABUNG SEKARANG" di sebelahnya.

**Tabel (dashboard)**
- Header UPPERCASE kecil abu, baris dipisah garis tipis, hover baris lebih terang.

**Seat map (Tahap 8)**
- Tersedia = abu terang, dipilih = oranye, ditahan = abu gelap bergaris, terjual = gelap, tidak bisa diklik.
- Legenda selalu terlihat. Area klik minimal 32px di mobile.

**Footer**
- Blok newsletter ("JANGAN LEWATKAN EVENT BERIKUTNYA"), kolom tautan, baris hak cipta,
  lalu wordmark "TIKETKU" raksasa oranye yang terpotong di tepi bawah halaman.

## 6. Struktur halaman home (mengikuti referensi)
1. **Hero:** foto gelap berkabut dengan glow oranye, tagline kecil, judul raksasa
   (mis. "TEMUKAN MOMEN BERIKUTNYA"), panel "EVENT BERIKUTNYA" (nama, tanggal, venue, jam),
   dua tombol: "BELI TIKET SEKARANG" (oranye) dan "LIHAT SEMUA EVENT" (outline).
2. **Pernyataan:** lencana angka kuning, kalimat besar, gambar di samping, tombol "PELAJARI".
3. **Judul besar dengan kata beraksen** + dua kolom teks + gambar + garis waktu (cerita platform).
4. **Event terbaru:** judul di kiri + daftar baris event di kanan.
5. **Countdown** event unggulan terdekat.
6. **Wordmark raksasa + barisan artis/line-up** dengan tag nama miring.
7. **Spotlight:** carousel berita/event populer.
8. **Statistik** tiga angka besar.
9. **Footer** dengan newsletter dan wordmark raksasa.

Halaman lain mewarisi token dan motif yang sama: katalog (filter + grid kartu),
detail event (hero banner, countdown, kategori tiket, tombol beli lengket di mobile),
checkout, e-ticket (kartu bergaya poster + QR), dashboard organizer.

## 7. Aturan untuk agent
- Semua warna, font, radius, dan spacing **harus** lewat token. Jangan hardcode hex atau px.
- Definisikan token di CSS Tailwind project (mis. blok `@theme` di `resources/css/app.css`,
  sesuaikan dengan struktur yang ada), lalu pakai sebagai utility class.
- Buat komponen Blade/Livewire reusable untuk motif khas (lencana miring, tag miring, kartu offset).
- Starter kit Livewire membawa komponen dan gaya bawaan. Override agar sesuai panduan ini.
- Wajib responsif (cek 375px, 768px, 1280px). Mobile dulu.
- Aksesibilitas: kontras teks minimal WCAG AA, fokus keyboard terlihat, `alt` di semua gambar,
  jangan andalkan warna saja untuk status. Teks di atas foto harus punya overlay gelap.
- Teks UI dalam bahasa Indonesia. Huruf kapital lewat CSS (`uppercase`), bukan diketik kapital.
- Gambar: pakai placeholder gradasi gelap bila aset belum ada. Jangan hotlink dari internet.
- Kerjakan satu halaman atau satu komponen per task. Urutan: token + layout dasar + navbar/footer,
  lalu komponen motif, lalu halaman home sebagai patokan halaman lain.
