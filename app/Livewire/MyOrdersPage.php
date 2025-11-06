<?php

namespace App\Livewire;

use App\Models\Order;
use Livewire\Component;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;

#[Title('Pesanan Saya')]
class MyOrdersPage extends Component
{
    use WithPagination;

    public function render()
    {
        // Eager load with specific columns to reduce data transfer
        $my_orders = Order::where('user_id', Auth::id())
            ->with([
                'items:id,order_id,product_id,quantity,unit_amount,total_amount', 
                'items.product:id,name,slug,image',
                'address:id,order_id,first_name,last_name,phone,street_address,city,state,zip_code'
            ])
            ->select('id', 'user_id', 'grand_total', 'payment_method', 'payment_status', 'status', 'created_at', 'updated_at')
            ->latest()
            ->paginate(10);
            
        return view('livewire.my-orders-page', [
            'orders' => $my_orders
        ]);
    }
}
