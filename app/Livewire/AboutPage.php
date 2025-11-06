<?php

namespace App\Livewire;

use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\StoreReview;
use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Tentang Kami - Munir Jaya Abadi')]
class AboutPage extends Component
{
    public function render()
    {
        // Calculate real statistics from database
        $stats = [
            'years_experience' => now()->year - 2010, // Since 2010
            'total_customers' => User::count(), // Total registered users
            'total_products' => Product::where('is_active', true)->count(),
            'total_orders' => Order::where('payment_status', 'paid')->count(),
            'average_rating' => round(StoreReview::where('is_published', true)->avg('rating') ?? 5.0, 1),
            'total_reviews' => StoreReview::where('is_published', true)->count(),
        ];

        return view('livewire.about-page', [
            'stats' => $stats
        ]);
    }
}
