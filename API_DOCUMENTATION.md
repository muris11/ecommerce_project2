# E-commerce API Documentation

API lengkap untuk aplikasi e-commerce dengan Laravel dan Laravel Sanctum.

## Base URL
```
http://localhost/api/v1
```

## Authentication
API menggunakan Laravel Sanctum untuk autentikasi. Setelah login, gunakan Bearer token di header:
```
Authorization: Bearer {your-token}
```

## Public Endpoints

### Auth
- `POST /auth/register` - Registrasi user baru
- `POST /auth/login` - Login user
- `POST /auth/forgot-password` - Kirim reset password link
- `POST /auth/reset-password` - Reset password

### Products
- `GET /products` - List semua produk aktif
- `GET /products/{slug}` - Detail produk
- `GET /products/featured` - Produk featured
- `GET /products/on-sale` - Produk sale

### Categories
- `GET /categories` - List semua kategori aktif
- `GET /categories/{slug}` - Detail kategori
- `GET /categories/{slug}/products` - Produk dalam kategori

### Brands
- `GET /brands` - List semua brand aktif
- `GET /brands/{slug}` - Detail brand
- `GET /brands/{slug}/products` - Produk dalam brand

## Protected Endpoints (Butuh Token)

### User Management
- `GET /auth/user` - Data user saat ini
- `PUT /auth/profile` - Update profile
- `PUT /auth/password` - Update password
- `POST /auth/logout` - Logout
- `GET /user/profile` - Profile lengkap user

### Cart Management
- `GET /cart` - Lihat isi keranjang
- `POST /cart/add` - Tambah produk ke keranjang
- `PUT /cart/update/{productId}` - Update quantity
- `DELETE /cart/remove/{productId}` - Hapus dari keranjang
- `DELETE /cart/clear` - Kosongkan keranjang
- `GET /cart/count` - Jumlah item
- `GET /cart/total` - Total harga

### Order Management
- `GET /orders` - List order user
- `POST /orders` - Buat order baru
- `GET /orders/{order}` - Detail order
- `PUT /orders/{order}/cancel` - Cancel order
- `GET /orders/{order}/invoice` - Invoice order

## Admin Endpoints (Butuh Admin Access)

### Product Management
- `GET /admin/products` - List semua produk
- `POST /admin/products` - Buat produk baru
- `PUT /admin/products/{product}` - Update produk
- `DELETE /admin/products/{product}` - Hapus produk
- `PUT /admin/products/{product}/toggle-active` - Toggle status aktif
- `PUT /admin/products/{product}/toggle-featured` - Toggle featured

### Category Management
- `GET /admin/categories` - List semua kategori
- `POST /admin/categories` - Buat kategori baru
- `PUT /admin/categories/{category}` - Update kategori
- `DELETE /admin/categories/{category}` - Hapus kategori
- `PUT /admin/categories/{category}/toggle-active` - Toggle status aktif

### Brand Management
- `GET /admin/brands` - List semua brand
- `POST /admin/brands` - Buat brand baru
- `PUT /admin/brands/{brand}` - Update brand
- `DELETE /admin/brands/{brand}` - Hapus brand
- `PUT /admin/brands/{brand}/toggle-active` - Toggle status aktif

### Order Management
- `GET /admin/orders` - List semua order
- `PUT /admin/orders/{order}/status` - Update status order
- `PUT /admin/orders/{order}/payment-status` - Update status pembayaran

### User Management
- `GET /admin/users` - List semua user
- `GET /admin/users/{user}` - Detail user
- `PUT /admin/users/{user}` - Update user
- `DELETE /admin/users/{user}` - Hapus user

### Analytics
- `GET /admin/analytics/dashboard` - Dashboard analytics
- `GET /admin/analytics/sales` - Sales analytics

## Example Usage

### 1. Register User
```bash
curl -X POST http://localhost/api/v1/auth/register \
  -H "Content-Type: application/json" \
  -d '{
    "name": "John Doe",
    "email": "john@example.com",
    "password": "password123",
    "password_confirmation": "password123"
  }'
```

### 2. Login
```bash
curl -X POST http://localhost/api/v1/auth/login \
  -H "Content-Type: application/json" \
  -d '{
    "email": "john@example.com",
    "password": "password123"
  }'
```

### 3. Get Products
```bash
curl -X GET "http://localhost/api/v1/products?search=laptop&category_id=1&min_price=100&max_price=1000&sort_by=price&sort_order=asc&per_page=10"
```

### 4. Add to Cart
```bash
curl -X POST http://localhost/api/v1/cart/add \
  -H "Authorization: Bearer {your-token}" \
  -H "Content-Type: application/json" \
  -d '{
    "product_id": 1,
    "quantity": 2
  }'
```

### 5. Create Order
```bash
curl -X POST http://localhost/api/v1/orders \
  -H "Authorization: Bearer {your-token}" \
  -H "Content-Type: application/json" \
  -d '{
    "items": [
      {
        "product_id": 1,
        "quantity": 2
      }
    ],
    "payment_method": "credit_card",
    "shipping_method": "standard",
    "shipping_amount": 10.00,
    "currency": "USD",
    "address": {
      "first_name": "John",
      "last_name": "Doe",
      "phone": "1234567890",
      "street_address": "123 Main St",
      "city": "Jakarta",
      "state": "DKI Jakarta",
      "zip_code": "12345"
    }
  }'
```

## Response Format

Semua response menggunakan format JSON standar:

### Success Response
```json
{
  "success": true,
  "message": "Success message",
  "data": {
    // Response data
  }
}
```

### Error Response
```json
{
  "success": false,
  "message": "Error message",
  "errors": {
    // Validation errors (jika ada)
  }
}
```

## Query Parameters

### Pagination
- `page` - Halaman (default: 1)
- `per_page` - Items per halaman (default: 15, max: 50)

### Sorting
- `sort_by` - Field untuk sorting
- `sort_order` - asc atau desc

### Filtering
- `search` - Pencarian teks
- `category_id` - Filter by kategori
- `brand_id` - Filter by brand
- `min_price` / `max_price` - Filter harga
- `featured` - Filter produk featured
- `on_sale` - Filter produk sale
- `in_stock` - Filter produk tersedia

## Status Codes

- `200` - Success
- `201` - Created
- `401` - Unauthorized
- `403` - Forbidden
- `404` - Not Found
- `422` - Validation Error
- `500` - Server Error