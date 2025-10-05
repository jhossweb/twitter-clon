<?php

namespace App\Livewire\Tweets;

use App\Models\Tweet;
use Livewire\Attributes\On;
use Livewire\Component;


class GetTweets extends Component
{
    public $perPage = 10;
    public $hasMorePages;

    public $tweets = [];


    function loadMore()
    {
        $this->perPage += 10;
    }

    function mount() {
        $this->getListTweets();
        
    }

    #[On('tweet-created')]
    function getListTweets() {
        
        $this->tweets = Tweet::with(['user', 'comments', 'images'])
                            ->latest()
                            ->get();

    }

    public function getTweetsProperty()
    {
        /*
        return Tweet::with(['user', 'media'])->latest()->get()->map(function ($tweet) {
            $tweet->media_grouped = collect($tweet->media)->groupBy(function ($file) {
                return str_starts_with($file->type, 'image') ? 'images' : 'videos';
            });
            return $tweet;
        });*/

        $tweets = Tweet::with(['user', 'media'])
                        ->latest()
                        ->limit($this->perPage + 1)
                        ->get();
        
        
        // verifica si se cargó el tweet extra
        $this->hasMorePages = $tweets->count() > $this->perPage;

        
        //deveulve sólo los tweets hasta el límite de perPage
        return $tweets->take($this->perPage);
    }



    public function render()
    {
        return view('livewire.tweets.get-tweets');
    }
}
