<?php

namespace App\Jobs;

use App\Livewire\Tweets\GetTweets;
use App\Models\Tweet;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Cache;

class RebuildTweetCache implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $listTweets = Tweet::with(['user', 'media'])
            ->latest('id', 'desc')
            ->limit(200)
            ->get();

        Cache::put(GetTweets::CACHE_KEY, $listTweets, now()->addMinutes(10));
    }
}
