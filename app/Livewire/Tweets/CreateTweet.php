<?php

namespace App\Livewire\Tweets;

use App\Models\Tweet;
use Livewire\Component;

class CreateTweet extends Component
{
    public $tweet_content = '';
    public $showModal = false;


    function createTweetModal() {
        $this->reset("tweet_content");
        $this->showModal = true;
    }

    function save()
    {
        Tweet::create([
            'tweet_content' => $this->tweet_content,
            'user_id' => auth()->id(),
        ]);
        
        $this->dispatch('tweet-created');
        $this->reset('tweet_content');
        $this->showModal = false;

        session()->flash('msg', 'tweet creado');
    }

    public function render()
    {
        return view('livewire.tweets.create-tweet');
    }
}
