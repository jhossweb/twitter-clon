<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Followers extends Model
{
    /** @use HasFactory<\Database\Factories\FollowersFactory> */
    use HasFactory;
    
    protected $fillable = [
        'follower_id',
        'followin_id',
    ];

    
}
