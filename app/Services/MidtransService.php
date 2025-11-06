<?php

namespace App\Services;

use App\Models\Order;
use Illuminate\Support\Facades\Log;
use Midtrans\Config;
use Midtrans\Snap;

class MidtransService
{
    public function __construct()
    {
        // Set your Merchant Server Key
        Config::$serverKey = config('midtrans.server_key');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        Config::$isProduction = false;
        // Set sanitization on (default)
        Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        Config::$is3ds = true;
    }

    public function createTransaction(Order $order)
    {
        // Generate unique order_id with timestamp to avoid duplicate
        $orderId = 'ORDER-' . $order->id . '-' . time();

        // Required - pastikan gross_amount dalam integer untuk avoid decimal issue
        $transaction_details = [
            'order_id' => $orderId,
            'gross_amount' => (int) $order->grand_total, // no decimal allowed for creditcard
        ];

        // Validate minimum amount
        if ($transaction_details['gross_amount'] < 1000) {
            Log::error('Midtrans minimum amount error', [
                'order_id' => $order->id,
                'amount' => $transaction_details['gross_amount']
            ]);
            return [
                'success' => false,
                'message' => 'Minimum transaction amount is IDR 1,000'
            ];
        }

        // Optional - Build item details
        $item_details = [];
        $items_subtotal = 0;
        
        foreach ($order->items as $item) {
            $itemPrice = (int) $item->unit_amount;
            $itemQty = (int) $item->quantity;
            
            $item_details[] = [
                'id' => 'ITEM-' . $item->product->id,
                'price' => $itemPrice,
                'quantity' => $itemQty,
                'name' => substr($item->product->name, 0, 50) // Limit name length
            ];
            
            $items_subtotal += ($itemPrice * $itemQty);
        }
        
        // CRITICAL: Add shipping cost as separate item
        if ($order->shipping_amount > 0) {
            $shippingCost = (int) $order->shipping_amount;
            
            // Build shipping label
            $shippingLabel = 'Ongkir';
            if ($order->shipping_courier) {
                $shippingLabel .= ' - ' . strtoupper($order->shipping_courier);
            }
            if ($order->shipping_service) {
                $shippingLabel .= ' ' . $order->shipping_service;
            }
            if ($order->shipping_etd) {
                $shippingLabel .= ' (' . $order->shipping_etd . ')';
            }
            
            $item_details[] = [
                'id' => 'SHIPPING-' . $order->id,
                'price' => $shippingCost,
                'quantity' => 1,
                'name' => substr($shippingLabel, 0, 50)
            ];
            
            $items_subtotal += $shippingCost;
        }
        
        // Validate: sum of item_details must equal gross_amount
        if ($items_subtotal != $transaction_details['gross_amount']) {
            Log::error('Midtrans amount mismatch', [
                'order_id' => $order->id,
                'gross_amount' => $transaction_details['gross_amount'],
                'items_subtotal' => $items_subtotal,
                'difference' => $transaction_details['gross_amount'] - $items_subtotal,
                'shipping_amount' => $order->shipping_amount
            ]);
            
            // Adjust to prevent error - add difference as adjustment
            if (abs($transaction_details['gross_amount'] - $items_subtotal) > 0) {
                $adjustment = $transaction_details['gross_amount'] - $items_subtotal;
                $item_details[] = [
                    'id' => 'ADJUSTMENT-' . $order->id,
                    'price' => $adjustment,
                    'quantity' => 1,
                    'name' => 'Penyesuaian'
                ];
            }
        }

        // Optional
        $customer_details = [
            'first_name'    => $order->user->name ?? 'Customer',
            'last_name'     => "",
            'email'         => $order->user->email ?? 'test@example.com',
            'phone'         => "08111222333",
        ];

        // Data yang akan dikirim untuk request redirect_url.
        $transaction = [
            'transaction_details' => $transaction_details,
            'customer_details' => $customer_details,
            'item_details' => $item_details,
        ];

        // Log transaction details sebelum kirim ke Midtrans
        Log::info('Creating Midtrans Snap Token', [
            'order_id' => $order->id,
            'midtrans_order_id' => $orderId,
            'gross_amount' => $transaction_details['gross_amount'],
            'items_count' => count($item_details),
            'item_details' => $item_details,
            'shipping_amount' => $order->shipping_amount,
            'customer_email' => $customer_details['email']
        ]);

        try {
            $snapToken = Snap::getSnapToken($transaction);
            
            // Log success dengan token
            Log::info('Snap Token Created Successfully', [
                'order_id' => $order->id,
                'midtrans_order_id' => $orderId,
                'token' => substr($snapToken, 0, 20) . '***',
                'token_length' => strlen($snapToken)
            ]);
            
            return [
                'success' => true,
                'snap_token' => $snapToken
            ];
        } catch (\Exception $e) {
            Log::error('Midtrans Snap Token Error', [
                'order_id' => $order->id,
                'midtrans_order_id' => $orderId,
                'error_message' => $e->getMessage(),
                'error_code' => $e->getCode(),
                'transaction_data' => $transaction
            ]);
            
            return [
                'success' => false,
                'message' => 'Failed to create payment token: ' . $e->getMessage()
            ];
        }
    }
}