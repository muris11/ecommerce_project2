# 🛍️ Munir Jaya Abadi - E-Commerce Platform

[![Laravel](https://img.shields.io/badge/Laravel-11.31-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)
[![Livewire](https://img.shields.io/badge/Livewire-3.5-4E56A6?style=for-the-badge&logo=livewire&logoColor=white)](https://livewire.laravel.com)
[![Filament](https://img.shields.io/badge/Filament-3.2-F59E0B?style=for-the-badge&logo=filament&logoColor=white)](https://filamentphp.com)
[![TailwindCSS](https://img.shields.io/badge/TailwindCSS-3.4-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)](https://tailwindcss.com)
[![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://php.net)
[![MySQL](https://img.shields.io/badge/MySQL-8.0-4479A1?style=for-the-badge&logo=mysql&logoColor=white)](https://mysql.com)

> Platform e-commerce modern dan lengkap dengan fitur admin panel, integrasi payment gateway, sistem pengiriman real-time, dan AI chatbot menggunakan teknologi terkini.

**🌐 Live Demo**: [munirjayaabadi.sikcb.my.id](https://munirjayaabadi.sikcb.my.id)

---

## 📋 Daftar Isi

-   [Tentang Project](#-tentang-project)
-   [Fitur Utama](#-fitur-utama)
-   [Tech Stack](#-tech-stack)
-   [Persyaratan Sistem](#-persyaratan-sistem)
-   [Instalasi](#-instalasi)
-   [Konfigurasi](#-konfigurasi)
-   [Database Schema](#-database-schema)
-   [API Documentation](#-api-documentation)
-   [Deployment](#-deployment)
-   [Screenshot](#-screenshot)
-   [Kontributor](#-kontributor)
-   [Lisensi](#-lisensi)

---

## 🎯 Tentang Project

**Munir Jaya Abadi** adalah platform e-commerce full-stack yang dibangun menggunakan Laravel 11 dengan Livewire 3 untuk interaktivitas real-time, Filament 3 untuk admin panel yang powerful, dan integrasi dengan berbagai layanan pihak ketiga.

### 🌟 Highlight

-   ✨ **Modern UI/UX** dengan TailwindCSS dan dark mode support
-   🚀 **Real-time** interaktivity dengan Livewire
-   🎨 **Powerful Admin Panel** menggunakan Filament 3
-   💳 **Multi Payment Gateway** (Midtrans, Stripe, COD)
-   📦 **Real-time Shipping** calculation dengan RajaOngkir API
-   🤖 **AI Chatbot** powered by Google Gemini
-   📧 **Email Notifications** untuk order management
-   🔐 **Secure Authentication** dan authorization
-   📱 **Fully Responsive** design
-   🌐 **SEO Optimized** dengan meta tags lengkap
-   🇮🇩 **Localized** untuk Indonesia (Bahasa Indonesia)

---

## ✨ Fitur Utama

### 🛒 Customer Features

#### 🏪 Shopping Experience

-   **Product Catalog** dengan filter dan sorting canggih
    -   Filter berdasarkan kategori, brand, harga, featured, on-sale
    -   Sorting by latest, price (low-high, high-low)
    -   Search functionality
    -   Product detail dengan multiple images
-   **Shopping Cart** dengan real-time updates
    -   Add/remove items
    -   Quantity adjustment
    -   Price calculation otomatis
    -   Persistent cart (cookie-based)
-   **Wishlist** untuk save produk favorit

#### 💰 Checkout & Payment

-   **Smart Checkout Flow**
    -   Real-time shipping cost calculation
    -   Multiple courier options (JNE, TIKI, POS, J&T, SiCepat, dll)
    -   Automatic address autocomplete via RajaOngkir
    -   ETD (Estimated Time Delivery) information
-   **Payment Methods**
    -   **Midtrans** (Credit Card, e-Wallet, Bank Transfer, dll)
    -   **Stripe** (International payments)
    -   **COD** (Cash on Delivery)
-   **Order Management**
    -   Order history tracking
    -   Real-time status updates
    -   Email notifications
    -   Invoice download (PDF)
    -   Waybill tracking

#### 🤖 AI Features

-   **Chatbot** powered by Google Gemini AI
    -   Product recommendations
    -   Customer support
    -   Order inquiry
    -   FAQs assistance

#### 👤 User Account

-   **Profile Management**
    -   Personal information
    -   Avatar upload
    -   Password change
    -   Email verification
-   **Order History**
    -   Detailed order view
    -   Status tracking
    -   Reorder functionality
-   **Product Reviews**
    -   Rating system (1-5 stars)
    -   Review submission
    -   Review moderation

---

### 🔧 Admin Features

#### 📊 Dashboard

-   **Analytics Overview**
    -   Total orders, revenue, customers
    -   Latest orders widget
    -   Revenue charts
    -   Best-selling products
-   **Statistics**
    -   Order status breakdown
    -   Payment status analytics
    -   Shipping method analysis

#### 🏢 Product Management

-   **CRUD Operations** untuk products
    -   Multiple image upload
    -   Category & brand assignment
    -   Stock management
    -   Pricing (regular price, sale price)
    -   Featured & on-sale flags
-   **Category Management**
    -   Hierarchical categories
    -   Image & icon support
    -   Active/inactive status
-   **Brand Management**
    -   Brand logos
    -   Brand visibility control

#### 📦 Order Management

-   **Comprehensive Order Control**
    -   Order listing dengan filter canggih
    -   Order detail view (infolist)
    -   Order status management (New → Processing → Shipped → Delivered)
    -   Payment status tracking
    -   Shipping information
    -   Quick actions (Ship, Cancel, Mark Delivered)
-   **Order Items**
    -   Product details
    -   Quantity & pricing
    -   Subtotal calculation
-   **Address Information**
    -   Customer delivery address
    -   Contact information

#### 👥 User Management

-   **Customer Management**
    -   User listing & search
    -   User details with avatar
    -   Email verification status
    -   Order history per user
    -   Quick access to user orders
-   **Role & Permission** (via Filament)

#### ⭐ Review Management

-   **Product Reviews**
    -   Review moderation
    -   Approval system
    -   Rating analytics
    -   Customer feedback

#### 📧 Contact Messages

-   **Customer Inquiries**
    -   Contact form submissions
    -   Read/unread status
    -   Email responses

#### ⚙️ Settings

-   **Filament Configuration**
    -   User profile management
    -   Avatar upload
    -   Password change
    -   Email preferences

---

## 🛠️ Tech Stack

### Backend

| Technology          | Version | Purpose              |
| ------------------- | ------- | -------------------- |
| **Laravel**         | 11.31   | PHP Framework        |
| **PHP**             | 8.2+    | Programming Language |
| **MySQL**           | 8.0+    | Database             |
| **Livewire**        | 3.5     | Full-stack Framework |
| **Filament**        | 3.2     | Admin Panel          |
| **Laravel Sanctum** | Latest  | API Authentication   |
| **Laravel Tinker**  | 2.9     | REPL                 |

### Frontend

| Technology      | Version | Purpose                             |
| --------------- | ------- | ----------------------------------- |
| **TailwindCSS** | 3.4.17  | CSS Framework                       |
| **Vite**        | 6.1.1   | Build Tool                          |
| **Axios**       | 1.7.4   | HTTP Client                         |
| **Preline**     | 2.7.0   | UI Components                       |
| **Alpine.js**   | -       | JavaScript Framework (via Livewire) |

### Integrations

| Service              | Purpose                     |
| -------------------- | --------------------------- |
| **Midtrans**         | Payment Gateway (Indonesia) |
| **Stripe**           | International Payment       |
| **RajaOngkir**       | Shipping Cost Calculation   |
| **Google Gemini AI** | AI Chatbot                  |
| **Gmail SMTP**       | Email Notifications         |

### Development Tools

| Tool                 | Version | Purpose      |
| -------------------- | ------- | ------------ |
| **Laravel Debugbar** | 3.16    | Debugging    |
| **Laravel Pint**     | 1.13    | Code Styling |
| **PHPUnit**          | 11.0.1  | Testing      |
| **Faker**            | 1.23    | Fake Data    |

---

## 💻 Persyaratan Sistem

### Minimum Requirements

```
- PHP >= 8.2
- Composer >= 2.0
- Node.js >= 18.x
- NPM >= 9.x
- MySQL >= 8.0 atau MariaDB >= 10.3
- Git
```

### PHP Extensions Required

```
- BCMath
- Ctype
- Fileinfo
- JSON
- Mbstring
- OpenSSL
- PDO
- PDO_MySQL
- Tokenizer
- XML
- cURL
- GD atau Imagick (untuk image processing)
```

### Server Requirements (Production)

```
- Apache/Nginx web server
- SSL Certificate (untuk HTTPS)
- Minimal 512 MB RAM (1 GB recommended)
- Minimal 1 GB disk space
- SSH access (untuk deployment)
```

---

## 🚀 Instalasi

### 1️⃣ Clone Repository

```bash
# Clone dari GitHub
git clone https://github.com/muris11/ecommerce_project2.git

# Masuk ke folder project
cd ecommerce_project2
```

### 2️⃣ Install Dependencies

```bash
# Install PHP dependencies
composer install

# Install JavaScript dependencies
npm install
```

### 3️⃣ Environment Configuration

```bash
# Copy file .env.example
cp .env.example .env

# Generate application key
php artisan key:generate
```

### 4️⃣ Database Setup

```bash
# Buat database MySQL
# Via MySQL CLI:
mysql -u root -p
CREATE DATABASE ecommerce_projeck2;
EXIT;

# Atau via phpMyAdmin/GUI tool

# Edit .env file dengan kredensial database Anda:
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ecommerce_projeck2
DB_USERNAME=root
DB_PASSWORD=

# Jalankan migrasi
php artisan migrate

# (Optional) Seed database dengan data sample
php artisan db:seed
```

### 5️⃣ Storage Link

```bash
# Link storage untuk file upload
php artisan storage:link
```

### 6️⃣ Build Assets

```bash
# Development
npm run dev

# Production
npm run build
```

### 7️⃣ Run Application

```bash
# Development server
php artisan serve

# Aplikasi akan berjalan di http://localhost:8000
```

### 8️⃣ Create Admin User

```bash
# Via Tinker
php artisan tinker

# Jalankan command berikut:
\App\Models\User::create([
    'name' => 'Admin',
    'email' => 'admin@munirjayaabadi.com',
    'password' => bcrypt('password'),
    'email_verified_at' => now()
]);

# Exit tinker
exit

# Login ke admin panel di: http://localhost:8000/admin
# Email: admin@munirjayaabadi.com
# Password: password
```

---

## ⚙️ Konfigurasi

### Environment Variables

Edit file `.env` untuk konfigurasi:

#### Aplikasi Dasar

```env
APP_NAME="Munir Jaya Abadi"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000
APP_TIMEZONE=Asia/Jakarta
APP_LOCALE=id
```

#### Database

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ecommerce_projeck2
DB_USERNAME=root
DB_PASSWORD=
```

#### Mail Configuration

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your_email@gmail.com
MAIL_PASSWORD=your_app_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=your_email@gmail.com
MAIL_FROM_NAME="${APP_NAME}"
```

**Cara mendapatkan Gmail App Password:**

1. Buka Google Account Settings
2. Security → 2-Step Verification → App passwords
3. Generate password untuk "Mail"
4. Copy password ke `MAIL_PASSWORD`

#### Midtrans Configuration

```env
MIDTRANS_MERCHANT_ID=your_merchant_id
MIDTRANS_CLIENT_KEY=your_client_key
MIDTRANS_SERVER_KEY=your_server_key
MIDTRANS_IS_PRODUCTION=false
MIDTRANS_IS_SANITIZED=true
MIDTRANS_IS_3DS=true
```

**Cara mendapatkan Midtrans credentials:**

1. Daftar di [Midtrans](https://midtrans.com)
2. Login ke Dashboard
3. Settings → Access Keys
4. Copy Client Key dan Server Key

#### Google Gemini AI

```env
GEMINI_API_KEY=your_gemini_api_key
GEMINI_MODEL=gemini-2.5-flash
GEMINI_MAX_TOKENS=500
GEMINI_TEMPERATURE=0.7
```

**Cara mendapatkan Gemini API Key:**

1. Buka [Google AI Studio](https://makersuite.google.com/app/apikey)
2. Create API Key
3. Copy ke `GEMINI_API_KEY`

#### RajaOngkir API

```env
RAJAONGKIR_API_KEY=your_api_key
RAJAONGKIR_BASE_URL=https://rajaongkir.komerce.id/api/v1
```

**Cara mendapatkan RajaOngkir API:**

1. Daftar di [RajaOngkir Komerce](https://rajaongkir.komerce.id)
2. Dapatkan API Key gratis
3. Copy ke `RAJAONGKIR_API_KEY`

---

## 🗄️ Database Schema

### ERD (Entity Relationship Diagram)

```
┌─────────────┐       ┌──────────────┐       ┌─────────────┐
│   Users     │──────<│    Orders    │>──────│  Addresses  │
└─────────────┘       └──────────────┘       └─────────────┘
                             │
                             │
                             ▼
                      ┌──────────────┐
                      │ Order Items  │
                      └──────────────┘
                             │
                             │
                             ▼
                      ┌──────────────┐       ┌─────────────┐
                      │   Products   │──────<│  Categories │
                      └──────────────┘       └─────────────┘
                             │
                             │
                             ▼
                      ┌──────────────┐
                      │    Brands    │
                      └──────────────┘
```

### Tabel Utama

#### users

```sql
- id (PK)
- name
- email (unique)
- email_verified_at
- password
- avatar (nullable)
- remember_token
- created_at, updated_at
```

#### products

```sql
- id (PK)
- category_id (FK)
- brand_id (FK)
- name
- slug (unique)
- image (JSON array)
- description (text)
- price (decimal)
- is_active (boolean)
- is_featured (boolean)
- in_stock (boolean)
- on_sale (boolean)
- created_at, updated_at
```

#### categories

```sql
- id (PK)
- name
- slug (unique)
- image (nullable)
- is_active (boolean)
- created_at, updated_at
```

#### brands

```sql
- id (PK)
- name
- slug (unique)
- image (nullable)
- is_active (boolean)
- created_at, updated_at
```

#### orders

```sql
- id (PK)
- user_id (FK)
- grand_total (decimal)
- payment_method (enum)
- payment_status (enum)
- status (enum)
- currency
- shipping_amount (decimal)
- shipping_method
- shipping_destination_id
- shipping_destination_name
- shipping_courier
- shipping_service
- shipping_cost (decimal)
- shipping_etd
- waybill (nullable)
- notes (text)
- created_at, updated_at
```

#### order_items

```sql
- id (PK)
- order_id (FK)
- product_id (FK)
- quantity (integer)
- unit_amount (decimal)
- total_amount (decimal)
- created_at, updated_at
```

#### addresses

```sql
- id (PK)
- order_id (FK)
- first_name
- last_name
- phone
- street_address (text)
- city
- state
- zip_code
- created_at, updated_at
```

#### reviews

```sql
- id (PK)
- user_id (FK)
- product_id (FK)
- rating (integer 1-5)
- comment (text)
- approved (boolean)
- created_at, updated_at
```

#### contact_messages

```sql
- id (PK)
- name
- email
- subject
- message (text)
- is_read (boolean)
- created_at, updated_at
```

---

## 📡 API Documentation

### Public Endpoints

#### Products

```http
GET /api/products
GET /api/products/{id}
GET /api/products/category/{category_slug}
GET /api/products/brand/{brand_slug}
```

#### Categories

```http
GET /api/categories
GET /api/categories/{slug}
```

#### Brands

```http
GET /api/brands
GET /api/brands/{slug}
```

### Authenticated Endpoints

#### Cart

```http
POST /api/cart/add
DELETE /api/cart/remove/{product_id}
PUT /api/cart/update/{product_id}
GET /api/cart
```

#### Orders

```http
POST /api/checkout
GET /api/orders
GET /api/orders/{id}
PUT /api/orders/{id}/cancel
```

#### User

```http
GET /api/user/profile
PUT /api/user/profile
PUT /api/user/password
```

### Response Format

**Success Response:**

```json
{
    "success": true,
    "data": {
        // response data
    },
    "message": "Success message"
}
```

**Error Response:**

```json
{
    "success": false,
    "message": "Error message",
    "errors": {
        // validation errors (if any)
    }
}
```

---

## 🚢 Deployment

### Production Checklist

-   [ ] Set `APP_ENV=production`
-   [ ] Set `APP_DEBUG=false`
-   [ ] Generate new `APP_KEY`
-   [ ] Configure production database
-   [ ] Setup SSL certificate (HTTPS)
-   [ ] Configure mail server
-   [ ] Setup backup strategy
-   [ ] Configure caching
-   [ ] Optimize autoloader
-   [ ] Run migrations
-   [ ] Build production assets
-   [ ] Set proper file permissions
-   [ ] Configure queue workers
-   [ ] Setup cron jobs
-   [ ] Configure monitoring
-   [ ] Update Midtrans to production keys

### Deploy ke cPanel

Lihat panduan lengkap di [DEPLOYMENT_GUIDE.md](DEPLOYMENT_GUIDE.md)

**Quick Steps:**

```bash
# 1. Upload files ke public_html/
# 2. Setup database di cPanel
# 3. Copy .env.production ke .env
# 4. Edit .env dengan kredensial database
# 5. Via SSH/Terminal:

cd public_html
composer install --optimize-autoloader --no-dev
php artisan key:generate
php artisan storage:link
php artisan migrate --force
php artisan config:cache
php artisan route:cache
php artisan view:cache
chmod -R 775 storage bootstrap/cache
```

### Deploy ke VPS (Ubuntu)

```bash
# 1. Install dependencies
sudo apt update
sudo apt install php8.2 php8.2-fpm php8.2-mysql php8.2-xml php8.2-mbstring php8.2-curl php8.2-zip nginx mysql-server

# 2. Install Composer
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer

# 3. Clone repository
cd /var/www
git clone https://github.com/muris11/ecommerce_project2.git
cd ecommerce_project2

# 4. Install dependencies
composer install --optimize-autoloader --no-dev
npm install
npm run build

# 5. Setup environment
cp .env.production .env
nano .env  # Edit database credentials

# 6. Setup Laravel
php artisan key:generate
php artisan storage:link
php artisan migrate --force
php artisan config:cache
php artisan route:cache
php artisan view:cache

# 7. Set permissions
sudo chown -R www-data:www-data /var/www/ecommerce_project2
sudo chmod -R 775 storage bootstrap/cache

# 8. Configure Nginx
sudo nano /etc/nginx/sites-available/munirjayaabadi

# 9. Enable site
sudo ln -s /etc/nginx/sites-available/munirjayaabadi /etc/nginx/sites-enabled/
sudo nginx -t
sudo systemctl restart nginx

# 10. Setup SSL with Let's Encrypt
sudo apt install certbot python3-certbot-nginx
sudo certbot --nginx -d munirjayaabadi.sikcb.my.id
```

---

## 📸 Screenshot

### Customer Interface

#### Homepage

![Homepage](docs/screenshots/homepage.png)

#### Products Page

![Products](docs/screenshots/products.png)

#### Product Detail

![Product Detail](docs/screenshots/product-detail.png)

#### Shopping Cart

![Cart](docs/screenshots/cart.png)

#### Checkout

![Checkout](docs/screenshots/checkout.png)

#### Payment

![Payment](docs/screenshots/payment.png)

#### My Orders

![My Orders](docs/screenshots/my-orders.png)

### Admin Panel

#### Dashboard

![Admin Dashboard](docs/screenshots/admin-dashboard.png)

#### Product Management

![Product Management](docs/screenshots/admin-products.png)

#### Order Management

![Order Management](docs/screenshots/admin-orders.png)

#### Order Detail

![Order Detail](docs/screenshots/admin-order-detail.png)

#### User Management

![User Management](docs/screenshots/admin-users.png)

---

## 🧪 Testing

### Run Tests

```bash
# Run all tests
php artisan test

# Run specific test
php artisan test --filter=ProductTest

# Run with coverage
php artisan test --coverage
```

### Manual Testing

```bash
# Test Midtrans payment
# Use test card: 4811 1111 1111 1114

# Test RajaOngkir
# Origin: Bunder, Indramayu (ID: 16238)
# Available couriers: JNE, TIKI, POS, J&T, SiCepat, etc.
```

---

## 🔧 Maintenance

### Cache Management

```bash
# Clear all caches
php artisan optimize:clear

# Cache config
php artisan config:cache

# Cache routes
php artisan route:cache

# Cache views
php artisan view:cache
```

### Database Backup

```bash
# Manual backup
mysqldump -u root -p ecommerce_projeck2 > backup.sql

# Restore
mysql -u root -p ecommerce_projeck2 < backup.sql
```

### Queue Workers

```bash
# Run queue worker
php artisan queue:work

# Run in background (production)
nohup php artisan queue:work &
```

### Scheduled Tasks

Add to crontab:

```bash
* * * * * cd /path/to/project && php artisan schedule:run >> /dev/null 2>&1
```

---

## 📚 Documentation

### Additional Docs

-   [Installation Guide](docs/INSTALLATION.md)
-   [Deployment Guide](DEPLOYMENT_GUIDE.md)
-   [API Reference](docs/API.md)
-   [Database Schema](docs/DATABASE.md)
-   [Troubleshooting](docs/TROUBLESHOOTING.md)

### Code Documentation

```bash
# Generate code documentation
composer require --dev mpociot/laravel-apidoc-generator
php artisan apidoc:generate
```

---

## 🤝 Kontributor

### Development Team

-   **Muhammad Rifqy Saputra** - _Lead Developer_ - [@muris11](https://github.com/muris11)

### Contributing

Kontribusi sangat diterima! Silakan:

1. Fork repository
2. Buat branch baru (`git checkout -b feature/AmazingFeature`)
3. Commit perubahan (`git commit -m 'Add some AmazingFeature'`)
4. Push ke branch (`git push origin feature/AmazingFeature`)
5. Buat Pull Request

### Code Style

```bash
# Format code dengan Laravel Pint
./vendor/bin/pint
```

---

## 📝 Changelog

### Version 1.0.0 (2025-11-06)

#### ✨ Features

-   Complete e-commerce functionality
-   Admin panel with Filament
-   Multi payment gateway integration
-   Real-time shipping calculation
-   AI chatbot with Google Gemini
-   Email notifications
-   Product reviews system
-   SEO optimization
-   Dark mode support
-   Indonesian localization

#### 🐛 Bug Fixes

-   Fixed grand total calculation
-   Fixed order edit form paths
-   Fixed price range filter
-   Fixed shipping address fields
-   Fixed cart management arguments

#### 🔧 Improvements

-   Optimized database migrations
-   Improved responsive design
-   Enhanced SEO meta tags
-   Better error handling
-   Performance optimization

---

## 🔐 Security

### Reporting Vulnerabilities

Jika Anda menemukan kerentanan keamanan, silakan email ke:
**rifqysaputra1102@gmail.com**

**Jangan** membuat issue publik untuk masalah keamanan.

### Security Best Practices

-   ✅ Input validation dan sanitization
-   ✅ CSRF protection (Laravel default)
-   ✅ SQL injection prevention (Eloquent ORM)
-   ✅ XSS protection
-   ✅ Password hashing (bcrypt)
-   ✅ Secure session handling
-   ✅ HTTPS enforced in production
-   ✅ API rate limiting
-   ✅ File upload validation

---

## 📜 Lisensi

Project ini dilisensikan di bawah [MIT License](LICENSE).

```
MIT License

Copyright (c) 2025 Muhammad Rifqy Saputra

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
```

---

## 🙏 Acknowledgments

### Libraries & Tools

-   [Laravel](https://laravel.com) - The PHP Framework
-   [Livewire](https://livewire.laravel.com) - Full-stack Framework
-   [Filament](https://filamentphp.com) - Admin Panel
-   [TailwindCSS](https://tailwindcss.com) - CSS Framework
-   [Alpine.js](https://alpinejs.dev) - JavaScript Framework
-   [Midtrans](https://midtrans.com) - Payment Gateway
-   [RajaOngkir](https://rajaongkir.com) - Shipping API
-   [Google Gemini](https://ai.google.dev) - AI Platform

### Inspiration

-   Laravel community
-   Filament community
-   Livewire community

---

## 📞 Contact & Support

### Developer

-   **Email**: rifqysaputra1102@gmail.com
-   **GitHub**: [@muris11](https://github.com/muris11)
-   **Project URL**: [https://github.com/muris11/ecommerce_project2](https://github.com/muris11/ecommerce_project2)

### Support

-   **Documentation**: [GitHub Wiki](https://github.com/muris11/ecommerce_project2/wiki)
-   **Issues**: [GitHub Issues](https://github.com/muris11/ecommerce_project2/issues)
-   **Discussions**: [GitHub Discussions](https://github.com/muris11/ecommerce_project2/discussions)

---

## 🌟 Star History

[![Star History Chart](https://api.star-history.com/svg?repos=muris11/ecommerce_project2&type=Date)](https://star-history.com/#muris11/ecommerce_project2&Date)

---

## 💖 Support This Project

Jika project ini membantu Anda, pertimbangkan untuk:

-   ⭐ Star repository ini
-   🐛 Report bugs
-   💡 Suggest new features
-   🔀 Submit pull requests
-   📢 Share dengan teman-teman

---

<div align="center">

**Built with ❤️ by Muhammad Rifqy Saputra**

[⬆ Back to Top](#-munir-jaya-abadi---e-commerce-platform)

</div>
