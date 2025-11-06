<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Products Table Indexes
        if (Schema::hasTable('products')) {
            Schema::table('products', function (Blueprint $table) {
                $table->index('is_active', 'idx_products_is_active');
                $table->index('on_sale', 'idx_products_on_sale');
                $table->index('is_featured', 'idx_products_is_featured');
                $table->index('created_at', 'idx_products_created_at');
                $table->index(['is_active', 'is_featured'], 'idx_products_active_featured');
                $table->index(['category_id', 'is_active'], 'idx_products_category_active');
                $table->index(['brand_id', 'is_active'], 'idx_products_brand_active');
            });
        }

        // Orders Table Indexes
        if (Schema::hasTable('orders')) {
            Schema::table('orders', function (Blueprint $table) {
                $table->index('user_id', 'idx_orders_user_id');
                $table->index('payment_status', 'idx_orders_payment_status');
                $table->index('status', 'idx_orders_status');
                $table->index('created_at', 'idx_orders_created_at');
                $table->index(['user_id', 'created_at'], 'idx_orders_user_created');
                $table->index(['user_id', 'status'], 'idx_orders_user_status');
            });
        }

        // Categories Table Indexes
        if (Schema::hasTable('categories')) {
            Schema::table('categories', function (Blueprint $table) {
                $table->index('is_active', 'idx_categories_is_active');
                $table->index('slug', 'idx_categories_slug');
            });
        }

        // Brands Table Indexes
        if (Schema::hasTable('brands')) {
            Schema::table('brands', function (Blueprint $table) {
                $table->index('is_active', 'idx_brands_is_active');
                $table->index('slug', 'idx_brands_slug');
            });
        }

        // Order Items Table Indexes
        if (Schema::hasTable('order_items')) {
            Schema::table('order_items', function (Blueprint $table) {
                $table->index('order_id', 'idx_order_items_order_id');
                $table->index('product_id', 'idx_order_items_product_id');
            });
        }

        // Addresses Table Indexes
        if (Schema::hasTable('addresses')) {
            Schema::table('addresses', function (Blueprint $table) {
                $table->index('order_id', 'idx_addresses_order_id');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Products Table Indexes
        if (Schema::hasTable('products')) {
            Schema::table('products', function (Blueprint $table) {
                $table->dropIndex('idx_products_is_active');
                $table->dropIndex('idx_products_on_sale');
                $table->dropIndex('idx_products_is_featured');
                $table->dropIndex('idx_products_created_at');
                $table->dropIndex('idx_products_active_featured');
                $table->dropIndex('idx_products_category_active');
                $table->dropIndex('idx_products_brand_active');
            });
        }

        // Orders Table Indexes
        if (Schema::hasTable('orders')) {
            Schema::table('orders', function (Blueprint $table) {
                $table->dropIndex('idx_orders_user_id');
                $table->dropIndex('idx_orders_payment_status');
                $table->dropIndex('idx_orders_status');
                $table->dropIndex('idx_orders_created_at');
                $table->dropIndex('idx_orders_user_created');
                $table->dropIndex('idx_orders_user_status');
            });
        }

        // Categories Table Indexes
        if (Schema::hasTable('categories')) {
            Schema::table('categories', function (Blueprint $table) {
                $table->dropIndex('idx_categories_is_active');
                $table->dropIndex('idx_categories_slug');
            });
        }

        // Brands Table Indexes
        if (Schema::hasTable('brands')) {
            Schema::table('brands', function (Blueprint $table) {
                $table->dropIndex('idx_brands_is_active');
                $table->dropIndex('idx_brands_slug');
            });
        }

        // Order Items Table Indexes
        if (Schema::hasTable('order_items')) {
            Schema::table('order_items', function (Blueprint $table) {
                $table->dropIndex('idx_order_items_order_id');
                $table->dropIndex('idx_order_items_product_id');
            });
        }

        // Addresses Table Indexes
        if (Schema::hasTable('addresses')) {
            Schema::table('addresses', function (Blueprint $table) {
                $table->dropIndex('idx_addresses_order_id');
            });
        }
    }
};
