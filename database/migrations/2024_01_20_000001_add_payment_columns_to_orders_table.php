<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        if (!Schema::hasColumn('orders', 'payment_method')) {
            Schema::table('orders', function (Blueprint $table) {
                $table->string('payment_method')->default('midtrans')->after('grand_total');
            });
        }
        
        if (!Schema::hasColumn('orders', 'payment_status')) {
            Schema::table('orders', function (Blueprint $table) {
                $table->enum('payment_status', ['pending', 'paid', 'failed'])->default('pending')->after('payment_method');
            });
        }
    }

    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['payment_method', 'payment_status']);
        });
    }
};