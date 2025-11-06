<?php

namespace App\Http\Controllers\Api;

use App\Helpers\CartManagement;
use App\Http\Controllers\Api\Concerns\TransformsOrders;
use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Order;
use App\Models\Product;
use App\Services\MidtransService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class CheckoutController extends Controller
{
    use TransformsOrders;

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:20'],
            'street_address' => ['required', 'string', 'max:500'],
            'city' => ['required', 'string', 'max:255'],
            'state' => ['required', 'string', 'max:255'],
            'zip_code' => ['required', 'string', 'max:10'],
            'payment_method' => ['required', 'in:midtrans,cod'],
        ]);

        $cartItems = CartManagement::getCartItemsFromCookie();
        $cartItems = is_array($cartItems) ? array_values($cartItems) : [];

        if (empty($cartItems)) {
            throw ValidationException::withMessages([
                'cart' => ['Cart is empty.'],
            ]);
        }

        $productIds = collect($cartItems)->pluck('product_id')->unique()->all();

        $products = Product::whereIn('id', $productIds)->get()->keyBy('id');

        $invalidItems = collect($cartItems)->filter(function ($item) use ($products) {
            $product = $products->get($item['product_id']);
            return !$product || !$product->is_active || !$product->in_stock;
        });

        if ($invalidItems->isNotEmpty()) {
            foreach ($invalidItems as $invalidItem) {
                CartManagement::removeCartItem($invalidItem['product_id']);
            }

            throw ValidationException::withMessages([
                'cart' => ['One or more items are no longer available.'],
            ]);
        }

        $grandTotal = CartManagement::calculateGrandTotal($cartItems);

        if ($grandTotal <= 0) {
            throw ValidationException::withMessages([
                'cart' => ['Invalid order amount.'],
            ]);
        }

        /** @var \App\Models\User $user */
        $user = $request->user();

        $order = DB::transaction(function () use ($validated, $cartItems, $grandTotal, $user) {
            $order = new Order();
            $order->user_id = $user->id;
            $order->grand_total = $grandTotal;
            $order->payment_method = $validated['payment_method'];
            $order->payment_status = 'pending';
            $order->status = 'new';
            $order->currency = 'idr';
            $order->shipping_amount = 0;
            $order->shipping_method = 'none';
            $order->notes = 'Order placed by ' . $user->name;
            $order->save();

            $address = new Address();
            $address->fill($validated);
            $address->order_id = $order->id;
            $address->save();

            $lineItems = collect($cartItems)->map(function ($item) {
                return [
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'unit_amount' => $item['unit_amount'],
                    'total_amount' => $item['total_amount'],
                ];
            })->all();

            $order->items()->createMany($lineItems);

            return $order;
        });

        $order->load(['items.product.category:id,name,slug', 'items.product.brand:id,name,slug', 'address', 'user']);

        $response = [
            'data' => $this->transformOrder($order, true),
        ];

        if ($order->payment_method === 'midtrans') {
            $midtransService = app(MidtransService::class);
            $result = $midtransService->createTransaction($order);

            if (!$result['success']) {
                throw ValidationException::withMessages([
                    'payment' => [$result['message']],
                ]);
            }

            $response['payment'] = [
                'provider' => 'midtrans',
                'snap_token' => $result['snap_token'],
            ];
        } else {
            CartManagement::clearCartItemsFromCookies();
        }

        return response()->json($response, 201);
    }
}
