<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Like extends Model
{
    /** @use HasFactory<\Database\Factories\LikeFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'likeable_id',
        'likeable_type',
    ];

    function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    function likeable(): MorphTo
    {
        return $this->morphTo();
    }

    /*
    protected static function booted()
    {
        static::created(function ($like) {
            $like->likeable?->increment('likes_count');
        });

        static::deleted(function ($like) {
            $like->likeable?->decrement('likes_count');
        });
    }*/

}
