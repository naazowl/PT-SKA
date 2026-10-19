# webs-company — PT Koneksi Solusi Anda

Starter website Company Profile Laravel 12 + MySQL XAMPP + Bootstrap 5.
Berisi halaman publik modern tanpa tombol login, halaman admin terpisah, CRUD Produk/Layanan, Artikel, dan Galeri, serta pengaturan profil perusahaan.

## 1. Persiapan
- PHP 8.2+, Composer, Node.js (opsional), dan XAMPP.
- Jalankan Apache dan MySQL dari XAMPP.
- Buat database bernama `webs_company` lewat phpMyAdmin (collation `utf8mb4_unicode_ci`).

## 2. Buat proyek Laravel
Di terminal:
```bash
composer create-project laravel/laravel webs-company "^12.0"
cd webs-company
```
Salin isi folder paket ini ke folder proyek Laravel yang baru dibuat, gabungkan folder dan izinkan file yang sama (`routes/web.php`, misalnya) untuk ditimpa. Simpan backup bila sudah punya kode.

## 3. Atur .env
Ubah bagian database:
```env
APP_NAME="Webs Company"
APP_URL=http://127.0.0.1:8000
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=webs_company
DB_USERNAME=root
DB_PASSWORD=
```
Sesuaikan username/password MySQL jika berbeda. Pastikan `config/database.php` masih memakai konfigurasi standar Laravel untuk MySQL.

## 4. Pasang file dan jalankan migrasi
```bash
php artisan key:generate
php artisan migrate --seed
php artisan serve
```
Buka `http://127.0.0.1:8000`.
Login admin hanya melalui URL khusus: `http://127.0.0.1:8000/admin/login`.
Akun demo: `admin@koneksi-solusi.test` / `Admin123!`
Ganti password demo setelah instalasi. Jangan deploy kredensial demo ke server publik.

## 5. Alur website
- Pengunjung: Beranda → Profil → Produk/Layanan → Artikel → Galeri → Kontak.
- Admin: `/admin/login` → Dashboard → kelola Produk, Artikel, Galeri, Profil.
- Tidak ada tombol/tautan login pada navigasi publik. Login admin hanya lewat URL yang diketahui pengelola.

## 6. Gambar
CRUD galeri menerima unggahan file dari komputer (bukan URL), memvalidasi gambar, dan menyimpannya di `storage/app/public`. Jalankan `php artisan storage:link` agar gambar dapat ditampilkan. Untuk gambar awal demo, gunakan placeholder CSS sehingga situs tetap tampil sebelum upload gambar sendiri.

## 7. Jika ada kendala
- `Unknown database`: buat database `webs_company` di phpMyAdmin.
- `could not find driver`: aktifkan ekstensi `pdo_mysql` di `php.ini` XAMPP/PHP CLI, lalu restart terminal/Apache.
- Gambar tidak muncul: `php artisan storage:link`.
- Error cache setelah ubah `.env`: `php artisan config:clear`.
- Pastikan terminal berada di folder `webs-company` saat menjalankan perintah Artisan.
