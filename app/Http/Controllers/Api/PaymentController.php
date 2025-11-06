<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Services\MidtransService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class PaymentController extends Controller
{
    public function show(Request $request, Order $order): JsonResponse
    {
        $user = $request->user();

        abort_if($order->user_id !== $user->id, 404);

        if ($order->payment_method !== 'midtrans') {
            throw ValidationException::withMessages([
                'payment_method' => ['Payment token is only available for Midtrans orders.'],
            ]);
        }

        $order->loadMissing([
            'items.product',
            'user',
        ]);

        if ($order->items->isEmpty()) {
            throw ValidationException::withMessages([
                'order' => ['Order does not contain any items.'],
            ]);
        }

        $midtransService = app(MidtransService::class);
        $result = $midtransService->createTransaction($order);

        if (!$result['success']) {
            throw ValidationException::withMessages([
                'payment' => [$result['message']],
            ]);
        }

        return response()->json([
            'data' => [
                'provider' => 'midtrans',
                'snap_token' => $result['snap_token'],
            ],
        ]);
    }
}

