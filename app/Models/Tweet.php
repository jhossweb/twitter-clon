<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Tweet extends Model
{
    /** @use HasFactory<\Database\Factories\TweetFactory> */
    use HasFactory;

    protected $fillable = [
        'tweet_content',
        'likes_count',
        'tweet_retweets',
        'tweet_comments',
        'user_id',
    ];


    function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    function comments(): HasMany
    {
        return $this->hasMany(TweetComments::class);
    }


    function images(): MorphMany
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    function likes(): MorphMany
    {
        return $this->morphMany(Like::class, 'likeable');
    }

    
}
