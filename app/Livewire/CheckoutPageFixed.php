<?php

namespace App\Livewire;

use App\Helpers\CartManagement;
use App\Models\Address;
use App\Models\Order;
use App\Services\MidtransService;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Checkout')]
class CheckoutPage extends Component
{
    public $first_name;
    public $last_name;
    public $phone;
    public $street_address;
    public $city;
    public $state;
    public $zip_code;
    public $payment_method = 'midtrans';
    public $snap_token = null;

    protected $rules = [
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'phone' => 'required|string|max:20',
        'street_address' => 'required|string|max:500',
        'city' => 'required|string|max:255',
        'state' => 'required|string|max:255',
        'zip_code' => 'required|string|max:10',
        'payment_method' => 'required|in:midtrans,cod',
    ];

    protected $midtransService;

    public function boot()
    {
        $this->midtransService = app(MidtransService::class);
    }

    public function mount()
    {
        $cart_items = CartManagement::getCartItemsFromCookie();
        CartManagement::fixCartImages();
        
        if(count($cart_items) == 0) {
            return redirect('/products');
        }
    }

    public function placeOrder()
    {
        $this->validate();

        $cart_items = CartManagement::getCartItemsFromCookie();

        $line_items = [];

        foreach($cart_items as $item) {
            $line_items[] = [
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'unit_amount' => $item['unit_amount'],
                'total_amount' => $item['total_amount'],
            ];
        }

        $order = new Order();
        $order->user_id = Auth::id();
        $order->grand_total = CartManagement::calculateGrandTotal($cart_items);
        $order->payment_method = $this->payment_method;
        $order->payment_status = 'pending';
        $order->status = 'new';
        $order->currency = 'idr';
        $order->shipping_amount = 0;
        $order->shipping_method = 'none';
        $order->notes = 'Order placed by ' . Auth::user()->name;

        $address = new Address();
        $address->first_name = $this->first_name;
        $address->last_name = $this->last_name;
        $address->phone = $this->phone;
        $address->street_address = $this->street_address;
        $address->city = $this->city;
        $address->state = $this->state;
        $address->zip_code = $this->zip_code;

        if($this->payment_method == 'midtrans') {
            $order->save();
            $address->order_id = $order->id;
            $address->save();
            $order->items()->createMany($line_items);
            
            // Create Midtrans transaction
            $midtransResult = $this->midtransService->createTransaction($order);
            
            if($midtransResult['success']) {
                $this->snap_token = $midtransResult['snap_token'];
                // Dispatch event to frontend to open Midtrans popup
                $this->dispatch('openMidtransPayment', $this->snap_token);
                return;
            } else {
                session()->flash('error', 'Payment initialization failed. Please try again.');
                return;
            }
        }

        // For COD orders
        $order->save();
        $address->order_id = $order->id;
        $address->save();
        $order->items()->createMany($line_items);

        CartManagement::clearCartItemsFromCookies();
        return redirect()->route('success');
    }

    public function render()
    {
        $cart_items = CartManagement::getCartItemsFromCookie();
        $grand_total = CartManagement::calculateGrandTotal($cart_items);
        
        return view('livewire.checkout-page', [
            'cart_items' => $cart_items,
            'grand_total' => $grand_total
        ]);
    }
}