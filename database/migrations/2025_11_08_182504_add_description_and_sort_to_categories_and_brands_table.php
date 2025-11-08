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
        // Add fields to categories table
        Schema::table('categories', function (Blueprint $table) {
            $table->text('description')->nullable()->after('slug');
            $table->integer('sort_order')->default(0)->after('is_active');
        });

        // Add fields to brands table
        Schema::table('brands', function (Blueprint $table) {
            $table->text('description')->nullable()->after('slug');
            $table->integer('sort_order')->default(0)->after('is_active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Remove fields from categories table
        Schema::table('categories', function (Blueprint $table) {
            $table->dropColumn(['description', 'sort_order']);
        });

        // Remove fields from brands table
        Schema::table('brands', function (Blueprint $table) {
            $table->dropColumn(['description', 'sort_order']);
        });
    }
};
