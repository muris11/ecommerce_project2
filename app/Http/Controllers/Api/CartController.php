<?php

namespace App\Http\Controllers\Api;

use App\Helpers\CartManagement;
use App\Http\Controllers\Api\Concerns\InteractsWithImages;
use App\Http\Controllers\Api\Concerns\TransformsProducts;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class CartController extends Controller
{
    use InteractsWithImages;
    use TransformsProducts;

    public function index(Request $request): JsonResponse
    {
        $items = CartManagement::fixCartImages();

        return $this->cartResponse($items, $request->boolean('with_products'));
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'product_id' => ['required', 'integer', 'exists:products,id'],
            'quantity' => ['sometimes', 'integer', 'min:1', 'max:100'],
            'with_products' => ['sometimes', 'boolean'],
        ]);

        $product = Product::where('id', $validated['product_id'])
            ->where('is_active', 1)
            ->first();

        if (!$product || !$product->in_stock) {
            throw ValidationException::withMessages([
                'product_id' => ['Product is not available.'],
            ]);
        }

        $quantity = $validated['quantity'] ?? 1;

        CartManagement::addItemToCartWithQty($product->id, $quantity);
        $items = CartManagement::fixCartImages();

        return $this->cartResponse($items, $request->boolean('with_products'));
    }

    public function update(Request $request, int $productId): JsonResponse
    {
        $validated = $request->validate([
            'quantity' => ['required', 'integer', 'min:0', 'max:100'],
            'with_products' => ['sometimes', 'boolean'],
        ]);

        $quantity = $validated['quantity'];

        if ($quantity === 0) {
            CartManagement::removeCartItem($productId);
        } else {
            $product = Product::where('id', $productId)->where('is_active', 1)->first();

            if (!$product || !$product->in_stock) {
                throw ValidationException::withMessages([
                    'product_id' => ['Product is not available.'],
                ]);
            }

            CartManagement::addItemToCartWithQty($product->id, $quantity);
        }

        $items = CartManagement::fixCartImages();

        return $this->cartResponse($items, $request->boolean('with_products'));
    }

    public function destroy(Request $request, int $productId): JsonResponse
    {
        CartManagement::removeCartItem($productId);
        $items = CartManagement::fixCartImages();

        return $this->cartResponse($items, $request->boolean('with_products'));
    }

    public function clear(Request $request): JsonResponse
    {
        CartManagement::clearCartItemsFromCookies();

        return $this->cartResponse([], $request->boolean('with_products'));
    }

    private function cartResponse(?array $items, bool $withProducts = false): JsonResponse
    {
        $items = is_array($items) ? array_values($items) : [];

        $collection = collect($items);
        $productIds = $collection->pluck('product_id')->filter()->unique()->all();

        $products = Product::with([
            'category:id,name,slug',
            'brand:id,name,slug',
        ])->whereIn('id', $productIds)->get()->keyBy('id');

        $data = $collection
            ->map(function (array $item) use ($products, $withProducts) {
                $product = $products->get($item['product_id']);
                $imagePath = $item['image'] ?? null;

                if (!$imagePath && $product) {
                    $images = $this->normalizeImageList($product->image ?? null);
                    $imagePath = $images[0] ?? null;
                }

                $formatted = [
                    'product_id' => $item['product_id'],
                    'name' => $item['name'] ?? ($product->name ?? null),
                    'slug' => $product->slug ?? null,
                    'quantity' => (int) ($item['quantity'] ?? 0),
                    'unit_amount' => (float) ($item['unit_amount'] ?? 0),
                    'total_amount' => (float) ($item['total_amount'] ?? 0),
                    'image_url' => $this->makeStorageUrl($imagePath),
                ];

                if ($withProducts && $product) {
                    $formatted['product'] = $this->transformProduct($product);
                }

                return $formatted;
            })
            ->values()
            ->all();

        return response()->json([
            'data' => $data,
            'meta' => [
                'count' => count($data),
                'grand_total' => (float) CartManagement::calculateGrandTotal($items),
            ],
        ]);
    }
}
