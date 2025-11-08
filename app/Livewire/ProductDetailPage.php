<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;
use Livewire\Attributes\Title;
use App\Helpers\CartManagement;
use App\Livewire\Partials\Navbar;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Traits\WithAlert;

#[Title('Detail Produk - Munir Jaya Abadi')]
class ProductDetailPage extends Component
{
    use LivewireAlert, WithAlert;

    public $slug;
    public $quantity = 1;

    public function mount($product){
        $this->slug = $product;
    }

    public function increaseQty(){
        $this->quantity++;
    }

    public function decreaseQty(){
        if($this->quantity > 1){
            $this->quantity--;
        }
    }

    //add product to cart method
    public function addToCart($product_id) {
        $total_count = CartManagement::addItemToCartWithQty($product_id, $this->quantity);
        $this->dispatch('update-cart-count', total_count: $total_count)->to(Navbar::class);
        $this->alertSuccess('Berhasil menambahkan produk ke keranjang');
    }

    public $rating = 5;
    public $comment = '';

    public function submitReview()
    {
        if (!Auth::check()) {
            $this->alertError('⚠️ Anda harus login untuk memberikan review');
            return redirect()->route('login');
        }

        $this->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|min:10',
        ], [
            'rating.required' => 'Rating harus diisi',
            'rating.min' => 'Rating minimal 1 bintang',
            'rating.max' => 'Rating maksimal 5 bintang',
            'comment.required' => 'Komentar harus diisi',
            'comment.min' => 'Komentar minimal 10 karakter',
        ]);

        $product = Product::where('slug', $this->slug)->firstOrFail();

        \App\Models\Review::create([
            'user_id' => Auth::id(),
            'product_id' => $product->id,
            'rating' => $this->rating,
            'comment' => $this->comment,
        ]);

        // Clear review cache for this product
        cache()->forget(config('cache_keys.keys.product_reviews') . $product->id);

        $this->alertSuccess('Review berhasil ditambahkan! Terima kasih atas feedback Anda.');

        $this->rating = 5;
        $this->comment = '';
    }

    public function render()
    {
        // Eager load brand and category relationships
        $product = Product::with(['brand:id,name,slug', 'category:id,name,slug'])
            ->where('slug', $this->slug)
            ->firstOrFail();

        // Get reviews directly (no cache for admin replies to show immediately)
        $reviews = \App\Models\Review::where('product_id', $product->id)
            ->with(['user:id,name,avatar'])
            ->select('id', 'user_id', 'product_id', 'rating', 'comment', 'admin_reply', 'replied_at', 'created_at')
            ->orderBy('created_at', 'desc')
            ->take(4)
            ->get();
        
        $count = \App\Models\Review::where('product_id', $product->id)->count();
        $average = \App\Models\Review::where('product_id', $product->id)->avg('rating');

        return view('livewire.product-detail-page', [
            'product' => $product,
            'recentReviews' => $reviews,
            'reviewCount' => $count,
            'averageRating' => $average ? round($average, 1) : 0,
        ]);
    }
}
