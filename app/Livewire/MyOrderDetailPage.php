<?php

namespace App\Livewire;

use App\Models\Address;
use App\Models\Order;
use Livewire\Component;
use App\Models\OrderItem;
use Livewire\Attributes\Title;

#[Title('Detail Pesanan')]
class MyOrderDetailPage extends Component
{

    public $order_id;

    public function mount($order_id){
        $this->order_id = $order_id;
    }
    public function render()
    {
        // Use single query with eager loading instead of 3 separate queries
        $order = Order::with([
            'items:id,order_id,product_id,quantity,unit_amount,total_amount',
            'items.product:id,name,slug,image',
            'address:id,order_id,first_name,last_name,phone,street_address,city,state,zip_code'
        ])
        ->select('id', 'user_id', 'grand_total', 'payment_method', 'payment_status', 'status', 'currency', 'shipping_amount', 'shipping_method', 'notes', 'created_at', 'updated_at')
        ->where('id', $this->order_id)
        ->firstOrFail();

        return view('livewire.my-order-detail-page', [
            'order_items' => $order->items,
            'address' => $order->address,
            'order' => $order
        ]);
    }

}
