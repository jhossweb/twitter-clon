<?php

namespace App\Livewire\Tweets;

use App\Models\Tweet;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Lazy;
use Livewire\Attributes\On;

#[Lazy()]
class GetTweets extends Component
{

    public ?User $user = null;

    public $perPage = 10;
    public $hasMorePages;
    public $tweetsList = null;

    const CACHE_KEY = 'tweets';


    function mount(?User $user = null)
    {
        $this->user = $user;
    }

    #[Computed()]
    public function getTweetsProperty()
    {
        // Si ya hay tweets en memoria, usar esa colección
        if ($this->tweetsList !== null) {
            $tweets = $this->tweetsList;
        }

        // Si estamos en perfil de usuario, cargar tweets sin caché
        elseif ($this->user) {
            $tweets = $this->fetchUserTweets($this->user);
            $this->tweetsList = $tweets;
        }

        // Si estamos en el feed global, usar caché
        else {
            $tweets = $this->fetchGlobalTweets();
            $this->tweetsList = $tweets;
        }

        // Determinar si hay más páginas
        $this->hasMorePages = $tweets->count() > $this->perPage;

        // Retornar los tweets paginados
        return $tweets->take($this->perPage);
    }

    protected function fetchUserTweets(User $user)
    {
        return Tweet::with([
            'user',
            'media',
            'comments.user',
            'likes.user'
        ])
        ->where('user_id', $user->id)
        ->latest('created_at')
        ->limit(100)
        ->get();
    }

    protected function fetchGlobalTweets()
    {
        return Cache::remember(self::CACHE_KEY, now()->addMinutes(10), function () {
            return Tweet::with([
                'user',
                'media',
                'comments.user',
                'likes.user'
            ])
            ->latest('created_at')
            ->limit(100)
            ->get();
        });
    }
    /*
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
        */

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