<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Ecommerce Projek 2 + Payment Gateway Midtrans

Website e-commerce berbasis Laravel dengan integrasi Payment Gateway Midtrans. Pengguna dapat belanja produk, melakukan pembayaran otomatis, dan admin dapat mengelola produk serta pesanan secara mudah.

## Fitur Utama

-   Integrasi Midtrans (Snap, pembayaran otomatis, update status order real-time)
-   Browsing dan pencarian produk
-   Detail produk lengkap
-   Keranjang belanja & checkout
-   Autentikasi pengguna
-   Panel admin (produk, kategori, pesanan)

## Persyaratan Sistem

-   PHP >= 7.4
-   Composer
-   MySQL
-   Web server (Apache/Nginx)
-   Node.js & npm

## Instalasi

1. Clone repository:
    ```bash
    git clone https://github.com/username/ecommerce-projek2.git
    cd ecommerce-projek2
    ```
2. Install dependensi PHP:
    ```bash
    composer install
    ```
3. Salin file .env dan isi konfigurasi database & Midtrans:
    ```bash
    cp .env.example .env
    ```
    - Isi MIDTRANS_SERVER_KEY, MIDTRANS_CLIENT_KEY, MIDTRANS_IS_PRODUCTION di .env
4. Generate application key:
    ```bash
    php artisan key:generate
    ```
5. Migrasi database:
    ```bash
    php artisan migrate
    ```
6. Install & build aset frontend:
    ```bash
    npm install
    npm run dev
    ```
7. Jalankan server lokal:
    ```bash
    php artisan serve
    ```
8. Akses aplikasi:
   http://localhost:8000

## Penggunaan

-   Buka homepage untuk belanja produk
-   Login/daftar untuk transaksi
-   Admin login untuk manajemen website

## Kontribusi

Kontribusi sangat terbuka! Ikuti panduan di [Laravel Contribution Guide](https://laravel.com/docs/contributions).

## Lisensi

Projek ini berlisensi [MIT](https://opensource.org/licenses/MIT).

# Ecommerce Projek 2 + Payment Gateway Midtrans

## Buku Panduan dan Instalasi

### Fitur Utama

-   Integrasi Payment Gateway Midtrans (Snap, pembayaran otomatis, status order real-time)
-   Browsing dan pencarian produk
-   Halaman detail produk dengan deskripsi dan gambar
-   Keranjang belanja dan proses checkout
-   Autentikasi pengguna (registrasi, login, logout)
-   Panel admin untuk manajemen produk, kategori, dan pesanan

### Persyaratan Sistem

-   PHP >= 7.4
-   Composer
-   MySQL
-   Web server seperti Apache atau Nginx
-   Node.js dan npm (untuk pengelolaan aset frontend)

### Langkah Instalasi

1. Clone repository ini:

    ```bash
    git clone https://github.com/username/ecommerce-projek2.git
    cd ecommerce-projek2
    ```

2. Install dependensi PHP menggunakan Composer:

    ```bash
    composer install
    ```

3. Salin file `.env.example` menjadi `.env` dan sesuaikan konfigurasi database serta Midtrans:

    ```bash
    cp .env.example .env
    ```

    - Isi MIDTRANS_SERVER_KEY, MIDTRANS_CLIENT_KEY, dan MIDTRANS_IS_PRODUCTION di file .env sesuai akun Midtrans Anda.

4. Generate application key:

    ```bash
    php artisan key:generate
    ```

5. Migrasi database:

    ```bash
    php artisan migrate
    ```

6. Install dependensi frontend:

    ```bash
    npm install
    ```

7. Compile aset frontend:

    ```bash
    npm run dev
    ```

8. Jalankan server lokal:

    ```bash
    php artisan serve
    ```

9. Akses aplikasi di browser:
    ```
    http://localhost:8000
    ```

### Demo

Anda dapat melihat demo aplikasi ini melalui tautan berikut:
[Demo Ecommerce Projek 2 + Payment Gateway Midtrans](https://demo-ecommerce-projek2.example.com)
