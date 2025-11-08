<?php

namespace App\Livewire;

use App\Models\Product;
use App\Models\Review;
use Livewire\Component;
use Livewire\WithPagination;

class ProductReviewsPage extends Component
{
    use WithPagination;

    public $slug;
    public $product;

    public function mount($product)
    {
        $this->slug = $product;
        $this->product = Product::where('slug', $product)->firstOrFail();
    }

    public function render()
    {
        $reviews = Review::where('product_id', $this->product->id)
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.product-reviews-page', [
            'reviews' => $reviews,
        ]);
    }
}
