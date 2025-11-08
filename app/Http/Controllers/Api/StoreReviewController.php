<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Concerns\TransformsReviews;
use App\Http\Controllers\Controller;
use App\Models\StoreReview;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StoreReviewController extends Controller
{
    use TransformsReviews;

    /**
     * Get all published store reviews
     */
    public function index(Request $request): JsonResponse
    {
        $perPage = (int) $request->integer('per_page', 10);
        $perPage = $perPage > 0 ? min($perPage, 50) : 10;

        $query = StoreReview::where('is_published', true)
            ->with(['user:id,name,avatar'])
            ->latest();

        if ($request->filled('rating')) {
            $query->where('rating', (int) $request->input('rating'));
        }

        if ($request->boolean('has_reply')) {
            $query->whereNotNull('admin_reply');
        }

        $reviews = $query->paginate($perPage)->withQueryString();

        $data = $reviews->getCollection()
            ->map(fn (StoreReview $review) => $this->transformStoreReview($review))
            ->all();

        return response()->json([
            'data' => $data,
            'meta' => [
                'current_page' => $reviews->currentPage(),
                'per_page' => $reviews->perPage(),
                'total' => $reviews->total(),
                'last_page' => $reviews->lastPage(),
                'has_more_pages' => $reviews->hasMorePages(),
            ],
        ]);
    }

    /**
     * Get a specific store review
     */
    public function show(Request $request, StoreReview $review): JsonResponse
    {
        // Only show published reviews to non-admin users
        if (!$review->is_published && (!$request->user() || !$request->user()->is_admin)) {
            abort(404);
        }

        // Only allow users to see their own unpublished reviews, or admins to see all
        if (!$review->is_published && $review->user_id !== $request->user()->id && !$request->user()->is_admin) {
            abort(404);
        }

        $review->load(['user:id,name,avatar']);

        return response()->json([
            'data' => $this->transformStoreReview($review),
        ]);
    }

    /**
     * Create a new store review
     */
    public function store(Request $request): JsonResponse
    {
        $user = $request->user();

        // Check if user already reviewed the store
        $existingReview = StoreReview::where('user_id', $user->id)->first();

        if ($existingReview) {
            return response()->json([
                'message' => 'You have already reviewed the store',
                'data' => $this->transformStoreReview($existingReview->load(['user:id,name,avatar'])),
            ], 409);
        }

        $validator = Validator::make($request->all(), [
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'required|string|min:10|max:2000',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }

        $review = StoreReview::create([
            'user_id' => $user->id,
            'rating' => $request->integer('rating'),
            'review' => $request->string('review')->trim(),
            'is_published' => false, // Reviews need admin approval
        ]);

        $review->load(['user:id,name,avatar']);

        return response()->json([
            'message' => 'Store review submitted successfully. It will be published after admin approval.',
            'data' => $this->transformStoreReview($review),
        ], 201);
    }

    /**
     * Update an existing store review
     */
    public function update(Request $request, StoreReview $review): JsonResponse
    {
        $user = $request->user();

        // Only allow users to update their own reviews
        if ($review->user_id !== $user->id) {
            abort(403, 'You can only update your own reviews');
        }

        // Don't allow updates if admin has replied or if it's published
        if ($review->hasReply() || $review->is_published) {
            return response()->json([
                'message' => 'Cannot update review that has been published or replied by admin',
            ], 422);
        }

        $validator = Validator::make($request->all(), [
            'rating' => 'sometimes|integer|min:1|max:5',
            'review' => 'sometimes|string|min:10|max:2000',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }

        $review->update($request->only(['rating', 'review']));
        $review->load(['user:id,name,avatar']);

        return response()->json([
            'message' => 'Store review updated successfully',
            'data' => $this->transformStoreReview($review),
        ]);
    }

    /**
     * Delete a store review
     */
    public function destroy(Request $request, StoreReview $review): JsonResponse
    {
        $user = $request->user();

        // Only allow users to delete their own reviews, or admins
        if ($review->user_id !== $user->id && !$user->is_admin) {
            abort(403, 'You can only delete your own reviews');
        }

        // Don't allow deletion if admin has replied
        if ($review->hasReply()) {
            return response()->json([
                'message' => 'Cannot delete review that has been replied by admin',
            ], 422);
        }

        $review->delete();

        return response()->json([
            'message' => 'Store review deleted successfully',
        ]);
    }

    /**
     * Get user's store reviews
     */
    public function userReviews(Request $request): JsonResponse
    {
        $user = $request->user();

        $reviews = StoreReview::where('user_id', $user->id)
            ->latest()
            ->get();

        $data = $reviews->map(fn (StoreReview $review) => $this->transformStoreReview($review))
            ->all();

        return response()->json([
            'data' => $data,
        ]);
    }
}