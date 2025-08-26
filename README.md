<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About This Project

This is an e-commerce website built using the Laravel framework. The website allows users to browse products, view product details, and make purchases. It includes features such as a shopping cart, user authentication, and an admin panel for managing products and orders.

## Features

-   Product browsing and search functionality.
-   Detailed product pages with descriptions and images.
-   Shopping cart and checkout process.
-   User authentication (registration, login, logout).
-   Admin panel for managing products, categories, and orders.

## Installation Instructions

Follow these steps to set up the project locally:

1. **Clone the Repository**:

    ```bash
    git clone https://github.com/your-username/ecommerce-projek2.git
    cd ecommerce-projek2
    ```

2. **Install Dependencies**:
   Make sure you have Composer installed, then run:

    ```bash
    composer install
    ```

3. **Set Up Environment Variables**:
   Copy the `.env.example` file to `.env`:

    ```bash
    cp .env.example .env
    ```

    Update the `.env` file with your database credentials and other configurations.

4. **Generate Application Key**:

    ```bash
    php artisan key:generate
    ```

5. **Run Migrations**:
   Set up the database tables:

    ```bash
    php artisan migrate
    ```

6. **Seed the Database** (Optional):
   Populate the database with sample data:

    ```bash
    php artisan db:seed
    ```

7. **Run the Development Server**:
   Start the Laravel development server:

    ```bash
    php artisan serve
    ```

    The application will be accessible at `http://localhost:8000`.

8. **Install Frontend Dependencies**:
   If the project uses frontend assets, install Node.js dependencies:
    ```bash
    npm install
    npm run dev
    ```

## Usage

-   Visit the homepage to browse products.
-   Register or log in to make purchases.
-   Admin users can log in to access the admin panel for managing the website.

## Contributing

Thank you for considering contributing to this project! Please follow the [contribution guide](https://laravel.com/docs/contributions).

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

# Ecommerce Projek 2

## Buku Panduan dan Instalasi

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

3. Salin file `.env.example` menjadi `.env` dan sesuaikan konfigurasi database:

    ```bash
    cp .env.example .env
    ```

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
[Demo Ecommerce Projek 2](https://demo-ecommerce-projek2.example.com)
