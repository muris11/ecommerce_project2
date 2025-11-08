<?php

namespace App\Http\Controllers\Api\Concerns;

use App\Models\Review;
use App\Models\StoreReview;

trait TransformsReviews
{
    protected function transformReview(Review $review): array
    {
        return [
            'id' => $review->id,
            'rating' => (int) $review->rating,
            'comment' => $review->comment,
            'admin_reply' => $review->admin_reply,
            'replied_at' => optional($review->replied_at)->toIso8601String(),
            'has_reply' => $review->hasReply(),
            'user' => $review->relationLoaded('user') && $review->user ? [
                'id' => $review->user->id,
                'name' => $review->user->name,
                'avatar_url' => $review->user->avatar_url,
            ] : null,
            'product' => $review->relationLoaded('product') && $review->product ? [
                'id' => $review->product->id,
                'name' => $review->product->name,
                'slug' => $review->product->slug,
                'primary_image_url' => $review->product->primary_image_url ?? null,
            ] : null,
            'created_at' => optional($review->created_at)->toIso8601String(),
            'updated_at' => optional($review->updated_at)->toIso8601String(),
        ];
    }

    protected function transformStoreReview(StoreReview $review): array
    {
        return [
            'id' => $review->id,
            'rating' => (int) $review->rating,
            'comment' => $review->comment,
            'admin_reply' => $review->admin_reply,
            'replied_at' => optional($review->replied_at)->toIso8601String(),
            'has_reply' => !is_null($review->admin_reply),
            'user' => $review->relationLoaded('user') && $review->user ? [
                'id' => $review->user->id,
                'name' => $review->user->name,
                'avatar_url' => $review->user->avatar_url,
            ] : null,
            'created_at' => optional($review->created_at)->toIso8601String(),
            'updated_at' => optional($review->updated_at)->toIso8601String(),
        ];
    }
}