<?php

namespace App\Livewire\Partials;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Helpers\CartManagement;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Traits\WithAlert;

class Navbar extends Component
{
    use LivewireAlert, WithAlert;

    public $total_count = 0;

    public function mount()
    {
        $items = CartManagement::getCartItemsFromCookie();
        $this->total_count = is_array($items) ? count($items) : 0;
    }

    #[On('update-cart-count')]
    public function updateCartCount($total_count)
    {
        $this->total_count = $total_count;
    }

    public function logout()
    {
        $userName = Auth::user()->name;
        Auth::logout();
        
        session()->invalidate();
        session()->regenerateToken();

        $this->alertSuccess('👋 Sampai jumpa, ' . $userName . '! Anda telah keluar dari akun.');

        return redirect()->route('home');
    }

    public function render()
    {
        return view('livewire.partials.navbar');
    }
}
