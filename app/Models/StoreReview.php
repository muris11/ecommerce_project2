<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StoreReview extends Model
{
    protected $fillable = [
        'user_id',
        'rating',
        'review',
        'admin_reply',
        'replied_at',
        'is_published',
    ];

    protected $casts = [
        'replied_at' => 'datetime',
        'is_published' => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function hasReply(): bool
    {
        return !is_null($this->admin_reply);
    }
}
