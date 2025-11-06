<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create Admin User
        User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );

        // Create Test User
        User::firstOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );

        // Create Brands
        $brands = [
            ['name' => 'Samsung', 'slug' => 'samsung', 'is_active' => true],
            ['name' => 'Apple', 'slug' => 'apple', 'is_active' => true],
            ['name' => 'Xiaomi', 'slug' => 'xiaomi', 'is_active' => true],
            ['name' => 'Oppo', 'slug' => 'oppo', 'is_active' => true],
            ['name' => 'Vivo', 'slug' => 'vivo', 'is_active' => true],
        ];

        foreach ($brands as $brand) {
            Brand::create($brand);
        }

        // Create Categories
        $categories = [
            ['name' => 'Smartphone', 'slug' => 'smartphone', 'is_active' => true],
            ['name' => 'Laptop', 'slug' => 'laptop', 'is_active' => true],
            ['name' => 'Tablet', 'slug' => 'tablet', 'is_active' => true],
            ['name' => 'Smartwatch', 'slug' => 'smartwatch', 'is_active' => true],
            ['name' => 'Aksesoris', 'slug' => 'aksesoris', 'is_active' => true],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }

        // Create Sample Products
        $products = [
            [
                'name' => 'Samsung Galaxy S23',
                'slug' => 'samsung-galaxy-s23',
                'description' => 'Smartphone flagship Samsung dengan performa terbaik',
                'price' => 12000000,
                'category_id' => 1,
                'brand_id' => 1,
                'is_active' => true,
                'is_featured' => true,
                'in_stock' => true,
                'on_sale' => false,
            ],
            [
                'name' => 'iPhone 15 Pro',
                'slug' => 'iphone-15-pro',
                'description' => 'iPhone terbaru dengan chip A17 Pro',
                'price' => 18000000,
                'category_id' => 1,
                'brand_id' => 2,
                'is_active' => true,
                'is_featured' => true,
                'in_stock' => true,
                'on_sale' => false,
            ],
            [
                'name' => 'Xiaomi 13T',
                'slug' => 'xiaomi-13t',
                'description' => 'Smartphone dengan kamera 200MP',
                'price' => 6500000,
                'category_id' => 1,
                'brand_id' => 3,
                'is_active' => true,
                'is_featured' => false,
                'in_stock' => true,
                'on_sale' => true,
            ],
            [
                'name' => 'Oppo Reno 10',
                'slug' => 'oppo-reno-10',
                'description' => 'Smartphone dengan desain premium',
                'price' => 5500000,
                'category_id' => 1,
                'brand_id' => 4,
                'is_active' => true,
                'is_featured' => false,
                'in_stock' => true,
                'on_sale' => false,
            ],
            [
                'name' => 'Vivo V29',
                'slug' => 'vivo-v29',
                'description' => 'Smartphone dengan kamera selfie terbaik',
                'price' => 4500000,
                'category_id' => 1,
                'brand_id' => 5,
                'is_active' => true,
                'is_featured' => false,
                'in_stock' => true,
                'on_sale' => false,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }

        $this->command->info('Database seeded successfully!');
        $this->command->info('Admin Email: admin@example.com');
        $this->command->info('Password: password');
    }
}
