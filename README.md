<p align="center">
  <img src="public/images/logo3.png" alt="Logo KopiPeteh" width="300" />
</p>

# KopiPeteh

**KopiPeteh** adalah aplikasi web lengkap untuk kedai kopi yang dibangun menggunakan framework **Laravel**. Aplikasi ini menghadirkan pengalaman pemesanan yang praktis bagi pelanggan serta dashboard manajemen yang komprehensif bagi admin. Sistem ini dilengkapi dengan kuota penjualan harian secara *real-time*, beragam metode pembayaran, dan kontrol penuh atas produk, kategori, serta pesanan.

## Features

### Fitur User

* **Halaman Utama (Landing Page):** Menampilkan status ketersediaan kuota harian secara langsung. Jika kuota sudah terpenuhi, sistem akan menginformasikan bahwa pemesanan sedang tidak tersedia.

* **Menu Produk:** Menampilkan daftar minuman kopi dan non-kopi yang dapat difilter berdasarkan kategori.

* **Keranjang Belanja:** Keranjang belanja berbasis *client-side* dengan pilihan varian **Iced** atau **Hot**.

* **Proses Checkout:** Pelanggan dapat membuat pesanan dengan mengisi data diri (nama dan nomor telepon) serta memilih metode pembayaran.

* **Pilihan Pembayaran:**

  * **Cash:** Pemesanan dibayar langsung di tempat.

  * **QRIS:** Alur pembayaran dua langkah, di mana pelanggan akan ditampilkan kode QRIS dan diminta mengonfirmasi pembayaran setelah jeda singkat.

* **Sistem Kuota Harian:** Batas maksimal penjualan adalah **10 cup per hari**. Sistem otomatis mengunci proses pemesanan saat kuota tercapai.

* **Halaman Detail Pesanan:** Setelah pesanan dibuat, pelanggan diarahkan ke halaman ringkasan yang memuat detail pesanan secara lengkap.

### Fitur Admin

* **Authentication:** Halaman login terpisah khusus untuk administrator.

* **Dashboard:** Ringkasan penjualan harian yang mencakup daftar pesanan terbaru, total cup terjual, statistik penjualan mingguan, dan total pendapatan mingguan.

* **Manajemen Produk:** Fitur CRUD lengkap (*Create, Read, Update, Delete*) untuk produk, termasuk unggah gambar, harga, deskripsi, dan status (`aktif`/`nonaktif`). Menggunakan *soft delete* agar riwayat pesanan tetap terjaga.

* **Manajemen Kategori:** Fitur CRUD lengkap untuk kategori produk. Kategori tidak dapat dihapus jika masih terhubung dengan produk (termasuk produk yang sudah di-*soft delete*).

* **Manajemen Pesanan:** Melihat seluruh riwayat dan pesanan yang sedang berlangsung, memfilter pesanan berdasarkan status (`belum bayar`, `menunggu`, `selesai`, `dibatalkan`), serta memperbarui status pesanan aktif.

* **Manajemen Profil:** Admin dapat memperbarui informasi pribadi dan mengubah kata sandi.

## Tech Stack

* **Backend:** PHP / Laravel 12

* **Frontend:** Blade, Vanilla CSS, Vanilla JavaScript

* **Build Tool:** Vite

* **Database:** MySQL, SQLite

## Getting Started

Ikuti langkah-langkah berikut untuk menjalankan proyek ini di komputer lokal Anda untuk keperluan pengembangan dan pengujian.

### Prasyarat

* PHP >= 8.2

* Composer

* Node.js & npm

* Database MySQL atau SQLite

### Instalasi

1. **Clone repository**

   ```
   git clone https://github.com/ish4l/kelompok6_kopipeteh.git
   cd kelompok6_kopipeteh
   
   ```

2. **Install dependency**

   ```
   composer install
   npm install
   
   ```

3. **Konfigurasi environment**

   * Salin file contoh konfigurasi:

     ```
     cp .env.example .env
     
     ```

   * Buat *application key* baru:

     ```
     php artisan key:generate
     
     ```

   * Atur koneksi database pada file `.env` (seperti `DB_CONNECTION` dan `DB_DATABASE`). Jika menggunakan SQLite, cukup buat file databasenya:

     ```
     touch database/database.sqlite
     
     ```

4. **Jalankan migration dan seeder database** Perintah ini akan membuat tabel yang dibutuhkan sekaligus mengisi data awal (akun admin, kategori produk, dan contoh produk):

   ```
   php artisan migrate --seed
   
   ```

5. **Buat symbolic link untuk storage**
   Diperlukan agar gambar produk yang diunggah dapat diakses secara publik:

   ```
   php artisan storage:link
   
   ```

6. **Build aset frontend**

   ```
   npm run build
   
   ```

7. **Jalankan server lokal**

   ```
   php artisan serve
   
   ```

   Aplikasi dapat diakses melalui `http://127.0.0.1:8000`.

## Login Admin

Setelah menjalankan seeder database, Anda dapat masuk ke panel admin melalui rute `/login` menggunakan kredensial default berikut:

* **Username:** `TehPeteh`

* **Password:** `admin123`
