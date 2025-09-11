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
            $table->index(['is_active', 'created_at']);
            $table->index(['is_featured', 'is_active']);
            $table->index(['in_stock', 'is_active']);
            $table->index('name'); // for search
            $table->index('price'); // for sorting
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->index(['status', 'created_at']);
            $table->index('created_at');
        });

        Schema::table('categories', function (Blueprint $table) {
            $table->index('name');
            $table->index(['is_active', 'name']);
        });

        Schema::table('brands', function (Blueprint $table) {
            $table->index('name');
            $table->index(['is_active', 'name']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropIndex(['is_active', 'created_at']);
            $table->dropIndex(['is_featured', 'is_active']);
            $table->dropIndex(['in_stock', 'is_active']);
            $table->dropIndex(['name']);
            $table->dropIndex(['price']);
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->dropIndex(['status', 'created_at']);
            $table->dropIndex(['created_at']);
        });

        Schema::table('categories', function (Blueprint $table) {
            $table->dropIndex(['name']);
            $table->dropIndex(['is_active', 'name']);
        });

        Schema::table('brands', function (Blueprint $table) {
            $table->dropIndex(['name']);
            $table->dropIndex(['is_active', 'name']);
        });
    }
};
