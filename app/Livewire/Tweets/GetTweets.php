<?php

namespace App\Livewire\Tweets;

use App\Models\Tweet;
use Livewire\Attributes\On;
use Livewire\Component;

class GetTweets extends Component
{
    public $tweets = [];

    function mount() {
        $this->getListTweets();
        
    }

    #[On('tweet-created')]
    function getListTweets() {
        $this->tweets = Tweet::latest()->get();
    }


    public function render()
    {
        return view('livewire.tweets.get-tweets');
    }
}
