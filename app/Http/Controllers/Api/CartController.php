<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Cookie;

class CartController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $cartItems = $this->getCartItems($request);
        $cartData = $this->calculateCartData($cartItems);

        return response()->json([
            'success' => true,
            'data' => $cartData
        ]);
    }

    public function add(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1|max:100'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], 422);
        }

        $product = Product::findOrFail($request->product_id);

        if (!$product->is_active || !$product->in_stock) {
            return response()->json([
                'success' => false,
                'message' => 'Product is not available'
            ], 422);
        }

        $cartItems = $this->getCartItems($request);

        // Check if product already exists in cart
        $existingItemKey = null;
        foreach ($cartItems as $key => $item) {
            if ($item['product_id'] == $request->product_id) {
                $existingItemKey = $key;
                break;
            }
        }

        if ($existingItemKey !== null) {
            // Update quantity of existing item
            $cartItems[$existingItemKey]['quantity'] += $request->quantity;
        } else {
            // Add new item to cart
            $cartItems[] = [
                'product_id' => $request->product_id,
                'quantity' => $request->quantity,
                'added_at' => now()->toISOString()
            ];
        }

        $response = response()->json([
            'success' => true,
            'message' => 'Product added to cart successfully',
            'data' => $this->calculateCartData($cartItems)
        ]);

        return $this->setCartCookie($response, $cartItems);
    }

    public function update(Request $request, $productId): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'quantity' => 'required|integer|min:1|max:100'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], 422);
        }

        $cartItems = $this->getCartItems($request);

        $itemFound = false;
        foreach ($cartItems as $key => $item) {
            if ($item['product_id'] == $productId) {
                $cartItems[$key]['quantity'] = $request->quantity;
                $itemFound = true;
                break;
            }
        }

        if (!$itemFound) {
            return response()->json([
                'success' => false,
                'message' => 'Product not found in cart'
            ], 404);
        }

        $response = response()->json([
            'success' => true,
            'message' => 'Cart item updated successfully',
            'data' => $this->calculateCartData($cartItems)
        ]);

        return $this->setCartCookie($response, $cartItems);
    }

    public function remove(Request $request, $productId): JsonResponse
    {
        $cartItems = $this->getCartItems($request);

        $itemFound = false;
        foreach ($cartItems as $key => $item) {
            if ($item['product_id'] == $productId) {
                unset($cartItems[$key]);
                $cartItems = array_values($cartItems); // Re-index array
                $itemFound = true;
                break;
            }
        }

        if (!$itemFound) {
            return response()->json([
                'success' => false,
                'message' => 'Product not found in cart'
            ], 404);
        }

        $response = response()->json([
            'success' => true,
            'message' => 'Product removed from cart successfully',
            'data' => $this->calculateCartData($cartItems)
        ]);

        return $this->setCartCookie($response, $cartItems);
    }

    public function clear(Request $request): JsonResponse
    {
        $response = response()->json([
            'success' => true,
            'message' => 'Cart cleared successfully',
            'data' => $this->calculateCartData([])
        ]);

        return $this->setCartCookie($response, []);
    }

    public function count(Request $request): JsonResponse
    {
        $cartItems = $this->getCartItems($request);
        $totalItems = array_sum(array_column($cartItems, 'quantity'));

        return response()->json([
            'success' => true,
            'data' => [
                'count' => $totalItems
            ]
        ]);
    }

    public function total(Request $request): JsonResponse
    {
        $cartItems = $this->getCartItems($request);
        $cartData = $this->calculateCartData($cartItems);

        return response()->json([
            'success' => true,
            'data' => [
                'subtotal' => $cartData['subtotal'],
                'total_items' => $cartData['total_items']
            ]
        ]);
    }

    private function getCartItems(Request $request): array
    {
        $cartCookie = $request->cookie('cart');

        if (!$cartCookie) {
            return [];
        }

        $cartItems = json_decode($cartCookie, true);

        return is_array($cartItems) ? $cartItems : [];
    }

    private function calculateCartData(array $cartItems): array
    {
        if (empty($cartItems)) {
            return [
                'items' => [],
                'total_items' => 0,
                'subtotal' => 0
            ];
        }

        $productIds = array_column($cartItems, 'product_id');
        $products = Product::whereIn('id', $productIds)
            ->where('is_active', true)
            ->where('in_stock', true)
            ->get()
            ->keyBy('id');

        $items = [];
        $subtotal = 0;
        $totalItems = 0;

        foreach ($cartItems as $cartItem) {
            $product = $products->get($cartItem['product_id']);

            if ($product) {
                $itemTotal = $product->price * $cartItem['quantity'];
                $subtotal += $itemTotal;
                $totalItems += $cartItem['quantity'];

                $items[] = [
                    'product_id' => $product->id,
                    'product' => [
                        'id' => $product->id,
                        'name' => $product->name,
                        'slug' => $product->slug,
                        'price' => $product->price,
                        'image' => $product->first_image,
                        'category' => $product->category ? $product->category->name : null,
                        'brand' => $product->brand ? $product->brand->name : null,
                    ],
                    'quantity' => $cartItem['quantity'],
                    'unit_price' => $product->price,
                    'total_price' => $itemTotal,
                    'added_at' => $cartItem['added_at'] ?? null
                ];
            }
        }

        return [
            'items' => $items,
            'total_items' => $totalItems,
            'subtotal' => $subtotal
        ];
    }

    private function setCartCookie($response, array $cartItems)
    {
        $cartJson = json_encode($cartItems);
        $minutes = 60 * 24 * 30; // 30 days

        return $response->withCookie(cookie('cart', $cartJson, $minutes));
    }
}