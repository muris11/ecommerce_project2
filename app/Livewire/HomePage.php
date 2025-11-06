<?php

namespace App\Livewire;

use App\Models\Brand;
use App\Models\Category;
use App\Models\StoreReview;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Beranda - Munir Jaya Abadi')]
class HomePage extends Component
{
    public function render()
    {
        // Cache brands for 5 minutes (development)
        $brands = cache()->remember('active_brands', 300, function () {
            return Brand::where('is_active', 1)
                ->select('id', 'name', 'slug', 'image')
                ->get();
        });
        
        // Cache categories for 5 minutes (development)
        $categories = cache()->remember('active_categories', 300, function () {
            return Category::where('is_active', 1)
                ->select('id', 'name', 'slug', 'image')
                ->get();
        });
        
        // Get latest store reviews (no cache for fresh data)
        $storeReviews = StoreReview::with(['user:id,name,avatar'])
            ->where('is_published', true)
            ->latest()
            ->take(3)
            ->get(['id', 'user_id', 'rating', 'review', 'created_at']);
        
        return view('livewire.home-page', [
            'brands' => $brands,
            'categories' => $categories,
            'storeReviews' => $storeReviews,
        ]);
    }
}
