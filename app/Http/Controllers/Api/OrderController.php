<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Address;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $query = Order::with(['items.product', 'address'])
            ->where('user_id', $request->user()->id);

        // Filter by status
        if ($request->has('status')) {
            $query->where('status', $request->get('status'));
        }

        // Filter by payment status
        if ($request->has('payment_status')) {
            $query->where('payment_status', $request->get('payment_status'));
        }

        // Sorting
        $sortBy = $request->get('sort_by', 'created_at');
        $sortOrder = $request->get('sort_order', 'desc');

        $allowedSorts = ['created_at', 'updated_at', 'grand_total'];
        if (in_array($sortBy, $allowedSorts)) {
            $query->orderBy($sortBy, $sortOrder);
        }

        // Pagination
        $perPage = min($request->get('per_page', 10), 50);
        $orders = $query->paginate($perPage);

        return response()->json([
            'success' => true,
            'data' => $orders
        ]);
    }

    public function show(Request $request, Order $order): JsonResponse
    {
        // Ensure user can only view their own orders
        if ($order->user_id !== $request->user()->id) {
            return response()->json([
                'success' => false,
                'message' => 'Order not found'
            ], 404);
        }

        $order->load(['items.product', 'address', 'user']);

        return response()->json([
            'success' => true,
            'data' => $order
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
            'payment_method' => 'required|string|in:credit_card,paypal,bank_transfer,cash_on_delivery,midtrans',
            'shipping_method' => 'required|string',
            'shipping_amount' => 'required|numeric|min:0',
            'currency' => 'required|string|size:3',
            'notes' => 'nullable|string|max:500',

            // Address fields
            'address.first_name' => 'required|string|max:255',
            'address.last_name' => 'required|string|max:255',
            'address.phone' => 'required|string|max:20',
            'address.street_address' => 'required|string|max:500',
            'address.city' => 'required|string|max:255',
            'address.state' => 'required|string|max:255',
            'address.zip_code' => 'required|string|max:10',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            DB::beginTransaction();

            $grandTotal = 0;
            $orderItems = [];

            // Calculate total and prepare order items
            foreach ($request->items as $item) {
                $product = Product::findOrFail($item['product_id']);

                if (!$product->is_active || !$product->in_stock) {
                    throw new \Exception("Product {$product->name} is not available");
                }

                $unitAmount = $product->price;
                $totalAmount = $unitAmount * $item['quantity'];
                $grandTotal += $totalAmount;

                $orderItems[] = [
                    'product_id' => $product->id,
                    'quantity' => $item['quantity'],
                    'unit_amount' => $unitAmount,
                    'total_amount' => $totalAmount,
                ];
            }

            $grandTotal += $request->shipping_amount;

            // Create order
            $order = Order::create([
                'user_id' => $request->user()->id,
                'grand_total' => $grandTotal,
                'payment_method' => $request->payment_method,
                'payment_status' => 'pending',
                'status' => 'new',
                'currency' => $request->currency,
                'shipping_amount' => $request->shipping_amount,
                'shipping_method' => $request->shipping_method,
                'notes' => $request->notes,
            ]);

            // Create order items
            foreach ($orderItems as $item) {
                $order->items()->create($item);
            }

            // Create address
            $order->address()->create($request->address);

            DB::commit();

            $order->load(['items.product', 'address']);

            return response()->json([
                'success' => true,
                'message' => 'Order created successfully',
                'data' => $order
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Failed to create order: ' . $e->getMessage()
            ], 500);
        }
    }

    public function cancel(Request $request, Order $order): JsonResponse
    {
        // Ensure user can only cancel their own orders
        if ($order->user_id !== $request->user()->id) {
            return response()->json([
                'success' => false,
                'message' => 'Order not found'
            ], 404);
        }

        // Check if order can be cancelled
        if (!in_array($order->status, ['new', 'processing'])) {
            return response()->json([
                'success' => false,
                'message' => 'Order cannot be cancelled'
            ], 422);
        }

        $order->update([
            'status' => 'cancelled',
            'payment_status' => 'cancelled'
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Order cancelled successfully',
            'data' => $order
        ]);
    }

    public function invoice(Request $request, Order $order): JsonResponse
    {
        // Ensure user can only view their own order invoices
        if ($order->user_id !== $request->user()->id) {
            return response()->json([
                'success' => false,
                'message' => 'Order not found'
            ], 404);
        }

        $order->load(['items.product', 'address', 'user']);

        // Calculate subtotal
        $subtotal = $order->items->sum('total_amount');

        $invoice = [
            'order' => $order,
            'subtotal' => $subtotal,
            'shipping' => $order->shipping_amount,
            'total' => $order->grand_total,
            'tax' => 0, // Add tax calculation if needed
        ];

        return response()->json([
            'success' => true,
            'data' => $invoice
        ]);
    }

    // // Admin methods
    // public function adminIndex(Request $request): JsonResponse
    // {
    //     $query = Order::with(['user', 'items.product', 'address']);

    //     // Filter by status
    //     if ($request->has('status')) {
    //         $query->where('status', $request->get('status'));
    //     }

    //     // Filter by payment status
    //     if ($request->has('payment_status')) {
    //         $query->where('payment_status', $request->get('payment_status'));
    //     }

    //     // Filter by date range
    //     if ($request->has('from_date')) {
    //         $query->whereDate('created_at', '>=', $request->get('from_date'));
    //     }

    //     if ($request->has('to_date')) {
    //         $query->whereDate('created_at', '<=', $request->get('to_date'));
    //     }

    //     // Search by order ID or user email
    //     if ($request->has('search')) {
    //         $search = $request->get('search');
    //         $query->where(function($q) use ($search) {
    //             $q->where('id', 'like', "%{$search}%")
    //               ->orWhereHas('user', function($userQuery) use ($search) {
    //                   $userQuery->where('email', 'like', "%{$search}%");
    //               });
    //         });
    //     }

    //     // Sorting
    //     $sortBy = $request->get('sort_by', 'created_at');
    //     $sortOrder = $request->get('sort_order', 'desc');

    //     $allowedSorts = ['id', 'created_at', 'grand_total', 'status', 'payment_status'];
    //     if (in_array($sortBy, $allowedSorts)) {
    //         $query->orderBy($sortBy, $sortOrder);
    //     }

    //     $perPage = min($request->get('per_page', 15), 100);
    //     $orders = $query->paginate($perPage);

    //     return response()->json([
    //         'success' => true,
    //         'data' => $orders
    //     ]);
    // }

    // public function updateStatus(Request $request, Order $order): JsonResponse
    // {
    //     $validator = Validator::make($request->all(), [
    //         'status' => 'required|string|in:new,processing,shipped,delivered,cancelled,refunded'
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Validation errors',
    //             'errors' => $validator->errors()
    //         ], 422);
    //     }

    //     $order->update(['status' => $request->status]);

    //     return response()->json([
    //         'success' => true,
    //         'message' => 'Order status updated successfully',
    //         'data' => $order
    //     ]);
    // }

    // public function updatePaymentStatus(Request $request, Order $order): JsonResponse
    // {
    //     $validator = Validator::make($request->all(), [
    //         'payment_status' => 'required|string|in:pending,paid,failed,refunded,cancelled'
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Validation errors',
    //             'errors' => $validator->errors()
    //         ], 422);
    //     }

    //     $order->update(['payment_status' => $request->payment_status]);

    //     return response()->json([
    //         'success' => true,
    //         'message' => 'Order payment status updated successfully',
    //         'data' => $order
    //     ]);
    // }

    // public function dashboard(): JsonResponse
    // {
    //     $totalOrders = Order::count();
    //     $totalRevenue = Order::where('payment_status', 'paid')->sum('grand_total');
    //     $pendingOrders = Order::where('status', 'new')->count();
    //     $todayOrders = Order::whereDate('created_at', today())->count();

    //     $recentOrders = Order::with(['user', 'items.product'])
    //         ->latest()
    //         ->limit(5)
    //         ->get();

    //     $dashboard = [
    //         'stats' => [
    //             'total_orders' => $totalOrders,
    //             'total_revenue' => $totalRevenue,
    //             'pending_orders' => $pendingOrders,
    //             'today_orders' => $todayOrders,
    //         ],
    //         'recent_orders' => $recentOrders
    //     ];

    //     return response()->json([
    //         'success' => true,
    //         'data' => $dashboard
    //     ]);
    // }

    // public function salesAnalytics(Request $request): JsonResponse
    // {
    //     $period = $request->get('period', '30'); // days

    //     $query = Order::where('payment_status', 'paid')
    //         ->where('created_at', '>=', now()->subDays($period));

    //     $salesData = $query->selectRaw('DATE(created_at) as date, COUNT(*) as orders, SUM(grand_total) as revenue')
    //         ->groupBy('date')
    //         ->orderBy('date')
    //         ->get();

    //     $topProducts = OrderItem::join('orders', 'order_items.order_id', '=', 'orders.id')
    //         ->join('products', 'order_items.product_id', '=', 'products.id')
    //         ->where('orders.payment_status', 'paid')
    //         ->where('orders.created_at', '>=', now()->subDays($period))
    //         ->selectRaw('products.name, SUM(order_items.quantity) as total_sold, SUM(order_items.total_amount) as revenue')
    //         ->groupBy('products.id', 'products.name')
    //         ->orderByDesc('total_sold')
    //         ->limit(10)
    //         ->get();

    //     return response()->json([
    //         'success' => true,
    //         'data' => [
    //             'period' => $period . ' days',
    //             'sales_chart' => $salesData,
    //             'top_products' => $topProducts
    //         ]
    //     ]);
    // }
}