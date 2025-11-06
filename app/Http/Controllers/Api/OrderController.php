<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Concerns\TransformsOrders;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    use TransformsOrders;

    public function index(Request $request): JsonResponse
    {
        $user = $request->user();

        $perPage = (int) $request->integer('per_page', 10);
        $perPage = $perPage > 0 ? min($perPage, 50) : 10;

        $orders = Order::where('user_id', $user->id)
            ->with('address')
            ->latest()
            ->paginate($perPage)
            ->withQueryString();

        $data = $orders->getCollection()
            ->map(fn (Order $order) => $this->transformOrder($order, $request->boolean('with_items')))
            ->all();

        return response()->json([
            'data' => $data,
            'meta' => [
                'current_page' => $orders->currentPage(),
                'per_page' => $orders->perPage(),
                'total' => $orders->total(),
                'last_page' => $orders->lastPage(),
                'has_more_pages' => $orders->hasMorePages(),
            ],
        ]);
    }

    public function show(Request $request, Order $order): JsonResponse
    {
        $user = $request->user();

        abort_if($order->user_id !== $user->id, 404);

        $order->load([
            'items.product.category:id,name,slug',
            'items.product.brand:id,name,slug',
            'address',
        ]);

        return response()->json([
            'data' => $this->transformOrder($order, true),
        ]);
    }
}

