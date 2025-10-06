<?php

namespace App\Livewire\Tweets;

use App\Models\Tweet;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Lazy;
use Livewire\Attributes\On;

#[Lazy()]
class GetTweets extends Component
{
    public $perPage = 10;
    public $hasMorePages;
    public $tweetsList = null;

    const CACHE_KEY = 'tweets';

    #[Computed()]
    public function getTweetsProperty()
    {
        if ($this->tweetsList !== null) {
            $tweetsList = $this->tweetsList;
        } else {
            $tweetsList = Cache::remember(self::CACHE_KEY, now()->addMinutes(10), function () {
                return Tweet::with([
                    'user',
                    'media',
                    'comments.user',
                    'likes.user'
                ])
                ->latest('created_at', 'desc')
                ->limit(100)
                ->get();
            });

            $this->tweetsList = $tweetsList;
        }

        $this->hasMorePages = $tweetsList->count() > $this->perPage;

        return $tweetsList->take($this->perPage);
    }

    function loadMore()
    {
        if ($this->hasMorePages) {
            $this->perPage += 10;
        }
    }

    #[On('tweet-created')]
    function updateFeedAndCache($tweetId)
    {
        $newTweet = Tweet::with([
            'user',
            'media',
            'comments.user',
            'likes.user'
        ])->findOrFail($tweetId);

        $this->getTweetsProperty();

        if ($this->tweetsList instanceof \Illuminate\Support\Collection) {
            $this->tweetsList->prepend($newTweet);
            $this->tweetsList = $this->tweetsList->take(100)->values(); // Reindexar y limitar
        } else {
            $this->tweetsList = collect([$newTweet]);
        }

        // Actualizar caché
        dispatch(new \App\Jobs\RebuildTweetCache());

        // Forzar re-render
        $this->perPage = $this->perPage;
    }

    public function render()
    {
        return view('livewire.tweets.get-tweets');
    }
}