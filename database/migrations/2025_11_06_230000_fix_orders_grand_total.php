<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Fix grand_total for existing orders using DB chunking for better performance
     */
    public function up(): void
    {
        // Use raw SQL with chunking to avoid memory issues on large datasets
        DB::table('orders')->orderBy('id')->chunk(100, function ($orders) {
            foreach ($orders as $order) {
                // Calculate items total
                $itemsTotal = DB::table('order_items')
                    ->where('order_id', $order->id)
                    ->sum('total_amount');
                
                $shippingAmount = $order->shipping_amount ?? 0;
                $correctGrandTotal = $itemsTotal + $shippingAmount;
                
                // Only update if grand_total is wrong
                if ($order->grand_total != $correctGrandTotal) {
                    \Illuminate\Support\Facades\Log::info('Fixing order grand_total', [
                        'order_id' => $order->id,
                        'old_grand_total' => $order->grand_total,
                        'new_grand_total' => $correctGrandTotal,
                        'items_total' => $itemsTotal,
                        'shipping_amount' => $shippingAmount
                    ]);
                    
                    DB::table('orders')
                        ->where('id', $order->id)
                        ->update(['grand_total' => $correctGrandTotal]);
                }
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Cannot reverse - data fix
    }
};
