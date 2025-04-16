<?php

namespace App\Helpers;

use App\Models\Product;
use Illuminate\Support\Facades\Cookie;

class CartManagement
{
    // Add item to cart
    static public function addItemToCart($product_id)
    {
        $cart_items = self::getCartItemsFromCookie();

        $existing_item_key = null;

        foreach ($cart_items as $key => $item) {
            if ($item['product_id'] == $product_id) {
                $existing_item_key = $key;
                break;
            }
        }

        if ($existing_item_key !== null) {
            // Item already exists, increment quantity
            $cart_items[$existing_item_key]['quantity']++;
            $cart_items[$existing_item_key]['total_amount'] =
                $cart_items[$existing_item_key]['quantity'] * $cart_items[$existing_item_key]['unit_amount'];
        } else {
            // Item doesn't exist, add new item
            $product = Product::where('id', $product_id)->first(['id', 'name', 'price', 'image']);
            if ($product) {
                $cart_items[] = [
                    'product_id' => $product->id,
                    'name' => $product->name,
                    'image' => $product->images,
                    'quantity' => 1,
                    'unit_amount' => $product->price,
                    'total_amount' => $product->price,
                ];
            }
        }

        self::addCartItemsToCookie($cart_items);

        return count($cart_items);
    }

    // Remove item from cart
    static public function removeCartItem($product_id)
    {
        $cart_items = self::getCartItemsFromCookie();

        foreach ($cart_items as $key => $item) {
            if ($item['product_id'] == $product_id) {
                unset($cart_items[$key]);
                break;
            }
        }

        $cart_items = array_values($cart_items); // reindex
        self::addCartItemsToCookie($cart_items);

        return count($cart_items);
    }

    // Add cart items to cookie
    static public function addCartItemsToCookie($cart_items)
    {
        Cookie::queue('cart_items', json_encode($cart_items), 60 * 24 * 30); // 30 hari
    }

    // Clear cart items from cookie
    static public function clearCartItems()
    {
        Cookie::queue(Cookie::forget('cart_items'));
    }

    // Get all cart items from cookie
    static public function getCartItemsFromCookie()
    {
        $cart_items = json_decode(Cookie::get('cart_items'), true);

        // return array even if null
        return is_array($cart_items) ? $cart_items : [];
    }

    // Increment item quantity
    static public function incrementQuantityToCartItem($product_id)
    {
        $cart_items = self::getCartItemsFromCookie();

        foreach ($cart_items as $key => $item) {
            if ($item['product_id'] == $product_id) {
                $cart_items[$key]['quantity']++;
                $cart_items[$key]['total_amount'] = $cart_items[$key]['quantity'] *
                    $cart_items[$key]['unit_amount'];
                break;
            }
        }

        self::addCartItemsToCookie($cart_items);

        return $cart_items;
    }

    // Decrement item quantity
    static public function decrementQuantityToCartItem($product_id)
    {
        $cart_items = self::getCartItemsFromCookie();

        foreach ($cart_items as $key => $item) {
            if ($item['product_id'] == $product_id && $cart_items[$key]['quantity'] > 1) {
                $cart_items[$key]['quantity']--;
                $cart_items[$key]['total_amount'] = $cart_items[$key]['quantity'] *
                    $cart_items[$key]['unit_amount'];
                break;
            }
        }

        self::addCartItemsToCookie($cart_items);

        return $cart_items;
    }

    // Calculate cart total
    static public function calculateGrandTotal($items)
    {
        return array_sum(array_column($items, 'total_amount'));
    }
}
