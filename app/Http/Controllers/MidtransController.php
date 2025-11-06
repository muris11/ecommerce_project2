<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Order;
use App\Helpers\CartManagement;

class MidtransController extends Controller
{
    // Endpoint for Midtrans server-to-server callback (webhook)
    public function callback(Request $request)
    {
        // Log raw payload for debugging
        Log::info('Midtrans callback received', ['payload' => $request->all()]);

        $serverKey = config('midtrans.server_key');
        $hashed = hash("sha512", $request->order_id . $request->status_code . $request->gross_amount . $serverKey);
        
        // Verify signature for security
        if ($hashed == $request->signature_key) {
            // Extract order ID from Midtrans order_id format (ORDER-{id}-{timestamp})
            $orderIdParts = explode('-', $request->order_id);
            if (count($orderIdParts) >= 2) {
                $orderId = $orderIdParts[1]; // Get the actual order ID
                $order = Order::find($orderId);
                
                if ($order) {
                    if ($request->transaction_status == 'capture' || $request->transaction_status == 'settlement') {
                        $order->payment_status = 'paid';
                        Log::info('Order payment status updated to paid via callback', ['order_id' => $orderId]);
                    } elseif ($request->transaction_status == 'pending') {
                        $order->payment_status = 'pending';
                        Log::info('Order payment status updated to pending via callback', ['order_id' => $orderId]);
                    } elseif ($request->transaction_status == 'deny' || $request->transaction_status == 'expire' || $request->transaction_status == 'cancel') {
                        $order->payment_status = 'failed';
                        Log::info('Order payment status updated to failed via callback', ['order_id' => $orderId]);
                    }
                    
                    $order->save();
                }
            }
        } else {
            Log::warning('Invalid Midtrans callback signature', ['order_id' => $request->order_id]);
        }

        return response()->json(['status' => 'ok']);
    }

    // Redirect after successful payment
    public function finish(Request $request)
    {
        // Clear cart after successful payment
        CartManagement::clearCartItemsFromCookies();
        
        Log::info('Payment finished - cart cleared', [
            'order_id' => $request->get('order_id'),
            'transaction_status' => $request->get('transaction_status')
        ]);
        
        return redirect()->route('success')->with('success', 'Pembayaran berhasil! Terima kasih atas pesanan Anda.');
    }

    // Redirect when payment is not finished (user closed popup)
    public function unfinish(Request $request)
    {
        return redirect('/my-orders')->with('warning', 'Pembayaran belum selesai. Anda dapat melanjutkan pembayaran nanti.');
    }

    // Redirect when payment failed
    public function error(Request $request)
    {
        return redirect('/my-orders')->with('error', 'Pembayaran gagal. Silakan coba lagi atau hubungi customer service.');
    }
}