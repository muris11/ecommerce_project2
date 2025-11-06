<?php

namespace App\Livewire;

use App\Models\Order;
use App\Services\MidtransService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Pembayaran Midtrans')]
class MidtransPaymentPage extends Component
{
    public $order;
    public $snapToken;
    public $error;

    public function mount($order)
    {
        try {
            $this->order = Order::with(['user', 'items.product', 'address'])->findOrFail($order);
            
            // Validate order data
            if (!$this->order->user) {
                throw new \Exception('Order user not found');
            }
            
            if ($this->order->items->isEmpty()) {
                throw new \Exception('Order has no items');
            }
            
            // Always generate fresh token untuk avoid expired token
            Log::info('Generating fresh Midtrans token for order', ['order_id' => $this->order->id]);
            
            $midtransService = new MidtransService();
            $result = $midtransService->createTransaction($this->order);
            
            if ($result['success']) {
                $this->snapToken = $result['snap_token'];
                Log::info('Payment page loaded successfully', [
                    'order_id' => $this->order->id,
                    'has_token' => !empty($this->snapToken)
                ]);
            } else {
                $this->error = $result['message'];
                Log::error('Failed to load payment page', [
                    'order_id' => $this->order->id,
                    'error' => $result['message']
                ]);
            }
            
        } catch (\Exception $e) {
            Log::error('Payment page mount error', [
                'order_id' => $order,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            $this->error = 'Payment error: ' . $e->getMessage();
        }
    }

    public function refreshToken()
    {
        if ($this->order) {
            Log::info('Refreshing Midtrans token', ['order_id' => $this->order->id]);
            
            $midtransService = new MidtransService();
            $result = $midtransService->createTransaction($this->order);
            
            if ($result['success']) {
                $this->snapToken = $result['snap_token'];
                $this->error = null;
                session()->flash('success', 'Token pembayaran berhasil diperbarui');
            } else {
                $this->error = $result['message'];
            }
        }
    }

    public function render()
    {
        return view('livewire.midtrans-payment-page');
    }
}