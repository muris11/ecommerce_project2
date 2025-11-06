<?php

namespace App\Livewire;

use App\Models\Brand;
use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use App\Helpers\CartManagement;
use App\Livewire\Partials\Navbar;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Traits\WithAlert;


#[Title('Produk - Munir Jaya Abadi')]
class ProductsPage extends Component{

    use WithPagination;

    use LivewireAlert, WithAlert;


    #[Url]
    public $selected_categories = [];

    #[Url]
    public $selected_brands = [];

    #[Url]
    public $featured;

    #[Url]
    public $on_sale;

    #[Url]
    public $price_range = 10000000;

    #[Url]
    public $sort = 'latest';

    //add product to cart method
    public function addToCart($product_id) {
        $total_count = CartManagement::addItemToCart($product_id);

        $this->dispatch('update-cart-count', total_count: $total_count)->to(Navbar::class);

        $this->alertSuccess('Berhasil menambahkan produk ke keranjang');
    }
    
    public function render()
    {
        // Select only needed columns for better performance
        $productQuery = Product::query()
            ->select('id', 'name', 'slug', 'image', 'price', 'is_active', 'is_featured', 'on_sale', 'category_id', 'brand_id')
            ->where('is_active', 1);

        if(!empty($this->selected_categories)) {
            $productQuery->whereIn('category_id', $this->selected_categories);
        }

        if(!empty($this->selected_brands)) {
            $productQuery->whereIn('brand_id', $this->selected_brands);
        }

        if($this->featured) {
            $productQuery->where('is_featured', 1);
        }

        if($this->on_sale) {
            $productQuery->where('on_sale', 1);
        }

        if($this->price_range) {
            $productQuery->whereBetween('price', [0, $this->price_range]);
        }

        if($this->sort == 'latest') {
            $productQuery->latest();
        }

        if($this->sort == 'price') {
            $productQuery->orderBy('price');
        }

        // Cache brands and categories for better performance
        $brands = cache()->remember('filter_brands', 3600, function () {
            return Brand::where('is_active', 1)->get(['id', 'name', 'slug']);
        });

        $categories = cache()->remember('filter_categories', 3600, function () {
            return Category::where('is_active', 1)->get(['id', 'name', 'slug']);
        });

        return view('livewire.products-page', [
            'products' => $productQuery->paginate(9),
            'brands' => $brands,
            'categories' => $categories,
        ]);
    }
}
