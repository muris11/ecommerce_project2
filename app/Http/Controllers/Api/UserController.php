<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function profile(Request $request): JsonResponse
    {
        $user = $request->user()->load(['orders' => function($query) {
            $query->latest()->limit(5);
        }]);

        return response()->json([
            'success' => true,
            'data' => $user
        ]);
    }

    public function updateProfile(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $request->user()->id,
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], 422);
        }

        $user = $request->user();
        $user->update($request->only('name', 'email'));

        return response()->json([
            'success' => true,
            'message' => 'Profile updated successfully',
            'data' => $user
        ]);
    }

    // // Admin methods
    // public function index(Request $request): JsonResponse
    // {
    //     $query = User::query();

    //     // Search functionality
    //     if ($request->has('search')) {
    //         $search = $request->get('search');
    //         $query->where(function($q) use ($search) {
    //             $q->where('name', 'like', "%{$search}%")
    //               ->orWhere('email', 'like', "%{$search}%");
    //         });
    //     }

    //     // Include orders count
    //     if ($request->boolean('with_orders_count')) {
    //         $query->withCount('orders');
    //     }

    //     // Filter by email verification
    //     if ($request->has('verified')) {
    //         if ($request->boolean('verified')) {
    //             $query->whereNotNull('email_verified_at');
    //         } else {
    //             $query->whereNull('email_verified_at');
    //         }
    //     }

    //     // Sorting
    //     $sortBy = $request->get('sort_by', 'created_at');
    //     $sortOrder = $request->get('sort_order', 'desc');

    //     $allowedSorts = ['id', 'name', 'email', 'created_at', 'email_verified_at'];
    //     if (in_array($sortBy, $allowedSorts)) {
    //         $query->orderBy($sortBy, $sortOrder);
    //     }

    //     // Pagination
    //     $perPage = min($request->get('per_page', 15), 100);
    //     $users = $query->paginate($perPage);

    //     return response()->json([
    //         'success' => true,
    //         'data' => $users
    //     ]);
    // }

    // public function show(User $user): JsonResponse
    // {
    //     $user->load(['orders' => function($query) {
    //         $query->with(['items.product', 'address'])->latest();
    //     }]);

    //     return response()->json([
    //         'success' => true,
    //         'data' => $user
    //     ]);
    // }

    // public function update(Request $request, User $user): JsonResponse
    // {
    //     $validator = Validator::make($request->all(), [
    //         'name' => 'sometimes|required|string|max:255',
    //         'email' => 'sometimes|required|string|email|max:255|unique:users,email,' . $user->id,
    //         'password' => 'sometimes|nullable|string|min:8',
    //         'email_verified_at' => 'nullable|date',
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Validation errors',
    //             'errors' => $validator->errors()
    //         ], 422);
    //     }

    //     $data = $request->only(['name', 'email', 'email_verified_at']);

    //     if ($request->filled('password')) {
    //         $data['password'] = Hash::make($request->password);
    //     }

    //     $user->update($data);

    //     return response()->json([
    //         'success' => true,
    //         'message' => 'User updated successfully',
    //         'data' => $user
    //     ]);
    // }

    // public function destroy(User $user): JsonResponse
    // {
    //     // Prevent deleting admin user
    //     if ($user->email === 'admin@gmail.com') {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Cannot delete admin user'
    //         ], 422);
    //     }

    //     // Check if user has orders
    //     if ($user->orders()->count() > 0) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Cannot delete user with existing orders'
    //         ], 422);
    //     }

    //     $user->delete();

    //     return response()->json([
    //         'success' => true,
    //         'message' => 'User deleted successfully'
    //     ]);
    // }
}