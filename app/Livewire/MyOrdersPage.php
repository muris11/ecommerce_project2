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

        $my_orders = Order::where('user_id', Auth::id())
            ->with(['items.product', 'address'])
            ->latest()
            ->paginate(10);
            
        return view('livewire.my-orders-page', [
            'orders' => $my_orders
        ]);
    }
}
