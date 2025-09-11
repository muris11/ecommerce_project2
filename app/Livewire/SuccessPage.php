<?php

namespace App\Livewire;

use Stripe\Stripe;
use App\Models\Order;
use Livewire\Component;
use Livewire\Attributes\Url;
use Stripe\Checkout\Session;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\Auth;

#[Title('Success - Munir Jaya Abadi')]
class SuccessPage extends Component
{
    #[Url]
    public $session_id;

    public function render()
    {
        $latest_order = Order::with('address')->where('user_id', Auth::user()->id)->latest()->first();

        // Handle Stripe payments
        if($this->session_id) {
            Stripe::setApiKey(env('STRIPE_SECRET'));
            $session_info = Session::retrieve($this->session_id);

            if($session_info->payment_status != 'paid') {
                $latest_order->payment_status = 'failed';
                $latest_order->save();
                return redirect()->route('cancel');
            } else if($session_info->payment_status == 'paid') {
                $latest_order->payment_status = 'paid';
                $latest_order->save();
            }
        }

        // Handle Midtrans payments
        // For Midtrans, we assume if user reaches success page, payment was successful
        if($latest_order && $latest_order->payment_method == 'midtrans' && $latest_order->payment_status == 'pending') {
            $latest_order->payment_status = 'paid';
            $latest_order->save();
            
            \Illuminate\Support\Facades\Log::info('Order payment status updated to paid', [
                'order_id' => $latest_order->id,
                'payment_method' => 'midtrans'
            ]);
        }

        return view('livewire.success-page' ,[
            'order' => $latest_order
        ]);
    }
}
