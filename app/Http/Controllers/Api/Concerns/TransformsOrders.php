<?php

namespace App\Http\Controllers\Api\Concerns;

use App\Models\Order;
use App\Models\OrderItem;

trait TransformsOrders
{
    use TransformsProducts;

    protected function transformOrder(Order $order, bool $withItems = false): array
    {
        $order->loadMissing([
            'address',
            'items.product.category:id,name,slug',
            'items.product.brand:id,name,slug',
        ]);

        $data = [
            'id' => $order->id,
            'grand_total' => (float) $order->grand_total,
            'payment_method' => $order->payment_method,
            'payment_status' => $order->payment_status,
            'status' => $order->status,
            'currency' => $order->currency,
            'shipping_amount' => (float) $order->shipping_amount,
            'shipping_method' => $order->shipping_method,
            'notes' => $order->notes,
            'created_at' => optional($order->created_at)->toIso8601String(),
            'updated_at' => optional($order->updated_at)->toIso8601String(),
        ];

        if ($order->relationLoaded('address') && $order->address) {
            $data['shipping_address'] = [
                'first_name' => $order->address->first_name,
                'last_name' => $order->address->last_name,
                'phone' => $order->address->phone,
                'street_address' => $order->address->street_address,
                'city' => $order->address->city,
                'state' => $order->address->state,
                'zip_code' => $order->address->zip_code,
            ];
        } else {
            $data['shipping_address'] = null;
        }

        if ($withItems) {
            $items = $order->relationLoaded('items')
                ? $order->items
                : collect();

            $data['items'] = $items
                ->map(function (OrderItem $item) {
                    $product = $item->relationLoaded('product') ? $item->product : null;

                    return [
                        'id' => $item->id,
                        'product_id' => $item->product_id,
                        'quantity' => (int) $item->quantity,
                        'unit_amount' => (float) $item->unit_amount,
                        'total_amount' => (float) $item->total_amount,
                        'product' => $product ? $this->transformProduct($product) : null,
                    ];
                })
                ->all();
        }

        return $data;
    }
}

