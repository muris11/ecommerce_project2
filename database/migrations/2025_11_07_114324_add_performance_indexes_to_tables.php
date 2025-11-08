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
        Schema::table('products', function (Blueprint $table) {
            // Add indexes for frequently queried columns
            $table->index('is_active');
            $table->index('is_featured');
            $table->index('on_sale');
            $table->index(['category_id', 'is_active']);
            $table->index(['brand_id', 'is_active']);
            $table->index(['price', 'is_active']);
            $table->index('created_at');
        });

        Schema::table('categories', function (Blueprint $table) {
            $table->index('is_active');
            $table->index('slug');
        });

        Schema::table('brands', function (Blueprint $table) {
            $table->index('is_active');
            $table->index('slug');
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->index(['user_id', 'status']);
            $table->index('status');
            $table->index('created_at');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->index('is_admin');
            $table->index('email_verified_at');
        });

        Schema::table('store_reviews', function (Blueprint $table) {
            $table->index(['is_published', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropIndex(['is_active']);
            $table->dropIndex(['is_featured']);
            $table->dropIndex(['on_sale']);
            $table->dropIndex(['category_id', 'is_active']);
            $table->dropIndex(['brand_id', 'is_active']);
            $table->dropIndex(['price', 'is_active']);
            $table->dropIndex(['created_at']);
        });

        Schema::table('categories', function (Blueprint $table) {
            $table->dropIndex(['is_active']);
            $table->dropIndex(['slug']);
        });

        Schema::table('brands', function (Blueprint $table) {
            $table->dropIndex(['is_active']);
            $table->dropIndex(['slug']);
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->dropIndex(['user_id', 'status']);
            $table->dropIndex(['status']);
            $table->dropIndex(['created_at']);
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropIndex(['is_admin']);
            $table->dropIndex(['email_verified_at']);
        });

        Schema::table('store_reviews', function (Blueprint $table) {
            $table->dropIndex(['is_published', 'created_at']);
        });
    }
};
