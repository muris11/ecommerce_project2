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
        Schema::table('orders', function (Blueprint $table) {
            $table->string('shipping_destination_id')->nullable()->after('payment_status');
            $table->string('shipping_destination_name')->nullable()->after('shipping_destination_id');
            $table->string('shipping_courier')->nullable()->after('shipping_destination_name');
            $table->string('shipping_service')->nullable()->after('shipping_courier');
            $table->decimal('shipping_cost', 10, 2)->default(0)->after('shipping_service');
            $table->string('shipping_etd')->nullable()->after('shipping_cost');
            $table->string('waybill')->nullable()->after('shipping_etd');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn([
                'shipping_destination_id',
                'shipping_destination_name',
                'shipping_courier',
                'shipping_service',
                'shipping_cost',
                'shipping_etd',
                'waybill',
            ]);
        });
    }
};
