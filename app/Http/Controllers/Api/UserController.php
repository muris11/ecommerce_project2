<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Concerns\TransformsUsers;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    use TransformsUsers;

    /**
     * Get authenticated user profile
     */
    public function show(Request $request): JsonResponse
    {
        $user = $request->user();

        return response()->json([
            'data' => $this->transformUserProfile($user),
        ]);
    }

    /**
     * Update user profile
     */
    public function update(Request $request): JsonResponse
    {
        $user = $request->user();

        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|string|min:2|max:255',
            'email' => ['sometimes', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'phone' => 'sometimes|string|min:10|max:20|regex:/^[0-9+\-\s()]+$/',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }

        $user->update($request->only(['name', 'email', 'phone']));

        return response()->json([
            'message' => 'Profile updated successfully',
            'data' => $this->transformUserProfile($user->fresh()),
        ]);
    }

    /**
     * Change user password
     */
    public function changePassword(Request $request): JsonResponse
    {
        $user = $request->user();

        $validator = Validator::make($request->all(), [
            'current_password' => 'required|string',
            'password' => 'required|string|min:8|confirmed|different:current_password',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }

        // Verify current password
        if (!Hash::check($request->string('current_password'), $user->password)) {
            return response()->json([
                'message' => 'Current password is incorrect',
                'errors' => ['current_password' => ['The current password is incorrect.']],
            ], 422);
        }

        $user->update([
            'password' => Hash::make($request->string('password')),
        ]);

        return response()->json([
            'message' => 'Password changed successfully',
        ]);
    }

    /**
     * Update user avatar
     */
    public function updateAvatar(Request $request): JsonResponse
    {
        $user = $request->user();

        $validator = Validator::make($request->all(), [
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // 2MB max
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }

        if ($request->hasFile('avatar')) {
            // Delete old avatar if exists
            if ($user->avatar && file_exists(storage_path('app/public/' . $user->avatar))) {
                unlink(storage_path('app/public/' . $user->avatar));
            }

            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $user->update(['avatar' => $avatarPath]);
        }

        return response()->json([
            'message' => 'Avatar updated successfully',
            'data' => $this->transformUserProfile($user->fresh()),
        ]);
    }

    /**
     * Delete user avatar
     */
    public function deleteAvatar(Request $request): JsonResponse
    {
        $user = $request->user();

        if ($user->avatar && file_exists(storage_path('app/public/' . $user->avatar))) {
            unlink(storage_path('app/public/' . $user->avatar));
        }

        $user->update(['avatar' => null]);

        return response()->json([
            'message' => 'Avatar deleted successfully',
            'data' => $this->transformUserProfile($user->fresh()),
        ]);
    }

    /**
     * Get user statistics
     */
    public function statistics(Request $request): JsonResponse
    {
        $user = $request->user();

        $stats = [
            'orders_count' => $user->orders()->count(),
            'reviews_count' => $user->reviews()->count(),
            'store_reviews_count' => $user->storeReviews()->count(),
            'total_spent' => $user->orders()->where('status', 'completed')->sum('total_amount'),
            'pending_orders' => $user->orders()->whereIn('status', ['pending', 'processing'])->count(),
            'completed_orders' => $user->orders()->where('status', 'completed')->count(),
        ];

        return response()->json([
            'data' => $stats,
        ]);
    }
}