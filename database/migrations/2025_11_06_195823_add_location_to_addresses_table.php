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
        Schema::table('addresses', function (Blueprint $table) {
            $table->string('subdistrict_id')->nullable()->after('state');
            $table->string('district_id')->nullable()->after('subdistrict_id');
            $table->string('city_name')->nullable()->after('district_id');
            $table->string('province_name')->nullable()->after('city_name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('addresses', function (Blueprint $table) {
            $table->dropColumn([
                'subdistrict_id',
                'district_id',
                'city_name',
                'province_name',
            ]);
        });
    }
};
