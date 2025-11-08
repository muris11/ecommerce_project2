<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Concerns\TransformsAddresses;
use App\Http\Controllers\Controller;
use App\Models\Address;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AddressController extends Controller
{
    use TransformsAddresses;
    /**
     * Get user's addresses
     */
    public function index(Request $request): JsonResponse
    {
        $user = $request->user();

        // For now, we'll get addresses from user's orders
        // In a real implementation, you'd have a separate UserAddress model
        $addresses = Address::whereHas('order', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })
        ->with(['order:id,user_id,status'])
        ->latest()
        ->get();

        $data = $addresses->map(function (Address $address) {
            return $this->transformAddress($address);
        })->all();

        return response()->json([
            'data' => $data,
        ]);
    }

    /**
     * Get a specific address
     */
    public function show(Request $request, Address $address): JsonResponse
    {
        $user = $request->user();

        // Check if address belongs to user's order
        if (!$address->order || $address->order->user_id !== $user->id) {
            abort(404);
        }

        return response()->json([
            'data' => $this->transformAddress($address),
        ]);
    }

    /**
     * Create a new address (for future use when we have UserAddress model)
     */
    public function store(Request $request): JsonResponse
    {
        // This would be implemented when we have a proper UserAddress model
        // For now, addresses are created during checkout

        return response()->json([
            'message' => 'Address creation is handled during checkout process',
        ], 501);
    }

    /**
     * Update an address (for future use)
     */
    public function update(Request $request, Address $address): JsonResponse
    {
        // This would be implemented when we have a proper UserAddress model
        return response()->json([
            'message' => 'Address update not implemented yet',
        ], 501);
    }

    /**
     * Delete an address (for future use)
     */
    public function destroy(Request $request, Address $address): JsonResponse
    {
        // This would be implemented when we have a proper UserAddress model
        return response()->json([
            'message' => 'Address deletion not implemented yet',
        ], 501);
    }

    /**
     * Transform address data for API response
     */
    protected function transformAddress(Address $address): array
    {
        return [
            'id' => $address->id,
            'first_name' => $address->first_name,
            'last_name' => $address->last_name,
            'full_name' => $address->full_name,
            'phone' => $address->phone,
            'street_address' => $address->street_address,
            'city' => $address->city,
            'state' => $address->state,
            'zip_code' => $address->zip_code,
            'order_id' => $address->order_id,
            'created_at' => optional($address->created_at)->toIso8601String(),
            'updated_at' => optional($address->updated_at)->toIso8601String(),
        ];
    }
}