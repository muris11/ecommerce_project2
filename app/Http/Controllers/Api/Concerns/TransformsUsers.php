<?php

namespace App\Http\Controllers\Api\Concerns;

use App\Models\User;

trait TransformsUsers
{
    protected function transformUser(User $user, bool $includeSensitive = false): array
    {
        $data = [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'phone' => $user->phone,
            'avatar_url' => $user->avatar_url,
            'email_verified_at' => optional($user->email_verified_at)->toIso8601String(),
            'is_admin' => (bool) $user->is_admin,
            'created_at' => optional($user->created_at)->toIso8601String(),
            'updated_at' => optional($user->updated_at)->toIso8601String(),
        ];

        // Include sensitive data only when explicitly requested
        if ($includeSensitive) {
            $data['orders_count'] = $user->relationLoaded('orders') ? $user->orders->count() : null;
            $data['reviews_count'] = $user->relationLoaded('reviews') ? $user->reviews->count() : null;
            $data['store_reviews_count'] = $user->relationLoaded('storeReviews') ? $user->storeReviews->count() : null;
        }

        return $data;
    }

    protected function transformUserProfile(User $user): array
    {
        return $this->transformUser($user, true);
    }
}