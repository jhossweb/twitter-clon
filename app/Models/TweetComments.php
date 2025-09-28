<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class TweetComments extends Model
{
    /** @use HasFactory<\Database\Factories\TweetCommentsFactory> */
    use HasFactory;

    protected $fillable = [
        'comment_content',
        'likes_count',
        'user_id',
        'tweet_id',
        'parent_id',
    ];


    function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    function tweet(): BelongsTo
    {
        return $this->belongsTo(Tweet::class, 'tweet_id');
    }

    function parent(): BelongsTo
    {
        return $this->belongsTo(TweetComments::class, 'parent_id');
    }

    function children(): HasMany
    {
        return $this->hasMany(TweetComments::class, 'parent_id');
    }


    // 1 imagen por comentario
    function image(): MorphOne
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    function likes(): MorphMany
    {
        return $this->morphMany(Like::class, 'likeable');
    }
    
    

    protected static function booted()
    {
        static::created(function ($comment) {
            $comment->tweet?->increment('comments_count');
        });

        static::deleted(function ($comment) {
            $comment->tweet?->decrement('comments_count');
        });
    }

}
