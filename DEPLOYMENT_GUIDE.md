# 🚀 PANDUAN HOSTING DI CPANEL

## Munir Jaya Abadi - munirjayaabadi.sikcb.my.id

---

## 📋 CHECKLIST PERSIAPAN

### ✅ File yang Sudah Disiapkan:

1. ✅ `.htaccess` (root) - Redirect ke public folder
2. ✅ `.htaccess` (public) - Laravel routing
3. ✅ `.env.production` - Template environment production
4. ✅ `robots.txt` - SEO crawling rules
5. ✅ `sitemap.xml` - SEO sitemap
6. ✅ Meta tags SEO di layout

---

## 🔧 LANGKAH DEPLOYMENT KE CPANEL

### 1️⃣ Upload Files ke cPanel

#### A. Via File Manager cPanel:

```
1. Login ke cPanel
2. Buka "File Manager"
3. Navigate ke folder root (biasanya public_html)
4. Upload semua file Laravel KECUALI:
   - node_modules/
   - .git/
   - vendor/ (akan di-install ulang)
```

#### B. Via FTP (Recommended):

```
1. Gunakan FileZilla atau software FTP
2. Connect ke server
3. Upload folder ke: /home/username/public_html/
```

#### C. Struktur Folder di cPanel:

```
public_html/
├── .htaccess              ← Redirect ke public/
├── .env                   ← Copy dari .env.production
├── app/
├── bootstrap/
├── config/
├── database/
├── public/
│   ├── .htaccess         ← Laravel routing
│   ├── index.php
│   ├── robots.txt
│   └── sitemap.xml
├── resources/
├── routes/
├── storage/
└── vendor/               ← Will be created by composer
```

---

### 2️⃣ Setup Database di cPanel

```sql
1. Buka "MySQL Databases" di cPanel
2. Create Database:
   - Nama: cpanel_username_ecommerce

3. Create User:
   - Username: cpanel_username_dbuser
   - Password: [Generate Strong Password]

4. Add User to Database:
   - Pilih user yang dibuat
   - Pilih database yang dibuat
   - Grant ALL PRIVILEGES

5. Catat informasi:
   - DB_HOST: localhost
   - DB_DATABASE: cpanel_username_ecommerce
   - DB_USERNAME: cpanel_username_dbuser
   - DB_PASSWORD: [Password yang di-generate]
```

---

### 3️⃣ Konfigurasi Environment (.env)

```bash
# Di cPanel File Manager atau via SSH:

1. Copy .env.production menjadi .env:
   cp .env.production .env

2. Edit file .env:
   - Ubah DB_DATABASE, DB_USERNAME, DB_PASSWORD
   - Ubah APP_URL ke: https://munirjayaabadi.sikcb.my.id
   - Set APP_ENV=production
   - Set APP_DEBUG=false
```

**File .env Production (Minimal)**:

```env
APP_NAME="Munir Jaya Abadi"
APP_ENV=production
APP_KEY=base64:jCy1EMlY6cOiaOMK++yIBU9PVd4ZbUHwX15NKLhPZls=
APP_DEBUG=false
APP_URL=https://munirjayaabadi.sikcb.my.id

DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=cpanel_username_ecommerce
DB_USERNAME=cpanel_username_dbuser
DB_PASSWORD=your_strong_password

# ... (copy semua setting lain dari .env.production)
```

---

### 4️⃣ Install Dependencies via SSH/Terminal

```bash
# Login SSH ke cPanel (jika tersedia)
# Atau gunakan Terminal di cPanel

cd /home/username/public_html

# 1. Install Composer dependencies
composer install --optimize-autoloader --no-dev

# 2. Generate Application Key (jika belum ada)
php artisan key:generate

# 3. Link storage
php artisan storage:link

# 4. Run migrations
php artisan migrate --force

# 5. Seed database (optional)
php artisan db:seed --force

# 6. Cache optimization
php artisan config:cache
php artisan route:cache
php artisan view:cache

# 7. Set permissions
chmod -R 755 storage bootstrap/cache
chmod -R 775 storage
chown -R username:username storage bootstrap/cache
```

---

### 5️⃣ Konfigurasi Domain di cPanel

#### A. Jika domain sudah pointing:

```
1. Di cPanel, buka "Addon Domains" atau "Parked Domains"
2. Tambahkan: munirjayaabadi.sikcb.my.id
3. Document Root harus ke: public_html/public
```

#### B. Jika belum pointing:

```
1. Update DNS domain di registrar:
   - Type: A Record
   - Name: @ atau munirjayaabadi
   - Value: [IP Address cPanel]

2. Tunggu propagasi DNS (1-24 jam)
```

---

### 6️⃣ SSL Certificate (HTTPS)

```
1. Di cPanel, buka "SSL/TLS Status"
2. AutoSSL akan otomatis install Let's Encrypt
3. Atau manual via "SSL/TLS" → "Manage SSL Sites"
```

---

### 7️⃣ Set Permissions (Security)

```bash
# Via SSH atau Terminal cPanel

# Folders
find . -type d -exec chmod 755 {} \;

# Files
find . -type f -exec chmod 644 {} \;

# Storage & Cache (writable)
chmod -R 775 storage
chmod -R 775 bootstrap/cache

# Protect .env
chmod 600 .env
```

---

## 🔍 SEO OPTIMIZATION YANG SUDAH DITERAPKAN

### ✅ 1. Meta Tags SEO

-   ✅ Title tags dinamis
-   ✅ Meta description
-   ✅ Meta keywords
-   ✅ Open Graph tags (Facebook)
-   ✅ Twitter Card tags
-   ✅ Canonical URLs
-   ✅ Schema.org markup (JSON-LD)

### ✅ 2. Robots.txt

```
Location: public/robots.txt
Status: Configured untuk allow crawling
```

### ✅ 3. Sitemap.xml

```
Location: public/sitemap.xml
URL: https://munirjayaabadi.sikcb.my.id/sitemap.xml
```

### ✅ 4. Performance

-   ✅ Asset optimization (Vite)
-   ✅ Gzip compression (.htaccess)
-   ✅ Browser caching
-   ✅ Laravel caching

---

## 📊 SUBMIT KE GOOGLE SEARCH CONSOLE

### Langkah 1: Verifikasi Domain

```
1. Buka: https://search.google.com/search-console
2. Klik "Add Property"
3. Pilih "URL prefix"
4. Masukkan: https://munirjayaabadi.sikcb.my.id
5. Verifikasi via:
   - HTML file upload, atau
   - Meta tag (sudah ada di layout), atau
   - Google Analytics
```

### Langkah 2: Submit Sitemap

```
1. Di Google Search Console
2. Menu "Sitemaps"
3. Submit: https://munirjayaabadi.sikcb.my.id/sitemap.xml
4. Klik "Submit"
```

### Langkah 3: Request Indexing

```
1. Di Google Search Console
2. Menu "URL Inspection"
3. Test setiap URL penting:
   - https://munirjayaabadi.sikcb.my.id
   - https://munirjayaabadi.sikcb.my.id/products
   - https://munirjayaabadi.sikcb.my.id/categories
4. Klik "Request Indexing"
```

---

## 🧪 TESTING CHECKLIST

### ✅ Functional Testing:

-   [ ] Homepage loading
-   [ ] Products page loading
-   [ ] Product detail page
-   [ ] Add to cart
-   [ ] Checkout flow
-   [ ] Payment (Midtrans)
-   [ ] User registration/login
-   [ ] Admin panel (/admin)

### ✅ SEO Testing:

-   [ ] Test robots.txt: https://munirjayaabadi.sikcb.my.id/robots.txt
-   [ ] Test sitemap.xml: https://munirjayaabadi.sikcb.my.id/sitemap.xml
-   [ ] Check meta tags (View Page Source)
-   [ ] Test mobile responsiveness
-   [ ] Check page speed: https://pagespeed.web.dev/

### ✅ Security Testing:

-   [ ] HTTPS working
-   [ ] .env not accessible
-   [ ] /admin requires authentication
-   [ ] File upload security

---

## ⚠️ TROUBLESHOOTING

### Error 500:

```bash
# Check logs
tail -f storage/logs/laravel.log

# Clear cache
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Check permissions
chmod -R 775 storage bootstrap/cache
```

### CSS/JS Not Loading:

```bash
# Build assets
npm run build

# Or copy build folder from local
```

### Database Connection Error:

```
1. Check .env credentials
2. Verify database exists in cPanel
3. Test connection via cPanel phpMyAdmin
```

### Session/Cache Issues:

```bash
php artisan cache:clear
php artisan session:clear
```

---

## 🔐 SECURITY CHECKLIST

-   [ ] APP_DEBUG=false di production
-   [ ] APP_ENV=production
-   [ ] Strong database password
-   [ ] .env file permissions: 600
-   [ ] HTTPS/SSL enabled
-   [ ] Regular backups setup
-   [ ] Firewall rules configured
-   [ ] Admin strong password
-   [ ] Two-factor authentication (recommended)

---

## 📈 POST-DEPLOYMENT

### 1. Monitor Performance

```
- Setup Google Analytics
- Monitor error logs
- Check server resources
```

### 2. SEO Tracking

```
- Google Search Console
- Google Analytics
- Bing Webmaster Tools
```

### 3. Backup Strategy

```
- Database backup daily
- File backup weekly
- Use cPanel backup feature
```

### 4. Updates

```
- Regular Laravel updates
- Package updates
- Security patches
```

---

## 📞 SUPPORT & MAINTENANCE

### Regular Tasks:

-   ✅ Check error logs weekly
-   ✅ Database backup
-   ✅ Update sitemap.xml when adding products
-   ✅ Monitor Google Search Console
-   ✅ Review analytics

### Performance Optimization:

```bash
# Monthly optimization
php artisan optimize
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

---

## 🎉 DEPLOYMENT COMPLETE!

**Live URL**: https://munirjayaabadi.sikcb.my.id  
**Admin Panel**: https://munirjayaabadi.sikcb.my.id/admin  
**Sitemap**: https://munirjayaabadi.sikcb.my.id/sitemap.xml

---

**Catatan Penting**:

1. ⚠️ Jangan lupa ubah Midtrans ke production keys sebelum go-live
2. ⚠️ Backup database sebelum migration
3. ⚠️ Test semua fitur sebelum production
4. ⚠️ Setup monitoring dan alert
5. ⚠️ Document semua credentials dengan aman

**Status**: ✅ READY FOR DEPLOYMENT
