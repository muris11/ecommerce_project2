<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Concerns\TransformsReviews;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ReviewController extends Controller
{
    use TransformsReviews;

    /**
     * Get reviews for a specific product
     */
    public function index(Request $request, Product $product): JsonResponse
    {
        $perPage = (int) $request->integer('per_page', 10);
        $perPage = $perPage > 0 ? min($perPage, 50) : 10;

        $query = Review::where('product_id', $product->id)
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
            ->map(fn (Review $review) => $this->transformReview($review))
            ->all();

        return response()->json([
            'data' => $data,
            'meta' => [
                'current_page' => $reviews->currentPage(),
                'per_page' => $reviews->perPage(),
                'total' => $reviews->total(),
                'last_page' => $reviews->lastPage(),
                'has_more_pages' => $reviews->hasMorePages(),
                'product' => [
                    'id' => $product->id,
                    'name' => $product->name,
                    'slug' => $product->slug,
                ],
            ],
        ]);
    }

    /**
     * Get a specific review
     */
    public function show(Request $request, Review $review): JsonResponse
    {
        // Only allow users to see their own reviews, or admins to see all
        if ($review->user_id !== $request->user()->id && !$request->user()->is_admin) {
            abort(404);
        }

        $review->load(['user:id,name,avatar', 'product:id,name,slug']);

        return response()->json([
            'data' => $this->transformReview($review),
        ]);
    }

    /**
     * Create a new review
     */
    public function store(Request $request, Product $product): JsonResponse
    {
        $user = $request->user();

        // Check if user already reviewed this product
        $existingReview = Review::where('user_id', $user->id)
            ->where('product_id', $product->id)
            ->first();

        if ($existingReview) {
            return response()->json([
                'message' => 'You have already reviewed this product',
                'data' => $this->transformReview($existingReview->load(['user:id,name,avatar', 'product:id,name,slug'])),
            ], 409);
        }

        $validator = Validator::make($request->all(), [
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|min:10|max:1000',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }

        $review = Review::create([
            'user_id' => $user->id,
            'product_id' => $product->id,
            'rating' => $request->integer('rating'),
            'comment' => $request->string('comment')->trim(),
        ]);

        $review->load(['user:id,name,avatar', 'product:id,name,slug']);

        return response()->json([
            'message' => 'Review created successfully',
            'data' => $this->transformReview($review),
        ], 201);
    }

    /**
     * Update an existing review
     */
    public function update(Request $request, Review $review): JsonResponse
    {
        $user = $request->user();

        // Only allow users to update their own reviews
        if ($review->user_id !== $user->id) {
            abort(403, 'You can only update your own reviews');
        }

        // Don't allow updates if admin has replied
        if ($review->hasReply()) {
            return response()->json([
                'message' => 'Cannot update review that has been replied by admin',
            ], 422);
        }

        $validator = Validator::make($request->all(), [
            'rating' => 'sometimes|integer|min:1|max:5',
            'comment' => 'sometimes|string|min:10|max:1000',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }

        $review->update($request->only(['rating', 'comment']));
        $review->load(['user:id,name,avatar', 'product:id,name,slug']);

        return response()->json([
            'message' => 'Review updated successfully',
            'data' => $this->transformReview($review),
        ]);
    }

    /**
     * Delete a review
     */
    public function destroy(Request $request, Review $review): JsonResponse
    {
        $user = $request->user();

        // Only allow users to delete their own reviews, or admins
        if ($review->user_id !== $user->id && !$user->is_admin) {
            abort(403, 'You can only delete your own reviews');
        }

        $review->delete();

        return response()->json([
            'message' => 'Review deleted successfully',
        ]);
    }

    /**
     * Get user's reviews
     */
    public function userReviews(Request $request): JsonResponse
    {
        $user = $request->user();

        $perPage = (int) $request->integer('per_page', 10);
        $perPage = $perPage > 0 ? min($perPage, 50) : 10;

        $reviews = Review::where('user_id', $user->id)
            ->with(['product:id,name,slug'])
            ->latest()
            ->paginate($perPage)
            ->withQueryString();

        $data = $reviews->getCollection()
            ->map(fn (Review $review) => $this->transformReview($review))
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
}