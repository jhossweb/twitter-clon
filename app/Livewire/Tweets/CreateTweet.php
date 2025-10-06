<?php

namespace App\Livewire\Tweets;

use App\Models\Tweet;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateTweet extends Component
{
    use WithFileUploads;


    #[Validate(['media.*' => 'nullable|file|max:10240|mimes:jpg,jpeg,png,mp4,mov'])]
    public $media = [];
    
    public $tweet_content = '';
    public $showModal = false;


    function createTweetModal() {
        $this->reset("tweet_content");
        $this->showModal = true;
    }

    function save()
    {
        $tweet = Tweet::create([
            'tweet_content' => $this->tweet_content,
            'user_id' => auth()->id(),
        ]);

        foreach ($this->media as $file) {
            $path = $file->store("tweets", 'public');

            $tweet->media()->create([
                'image_url' => $path,
            ]);
        }
        
        $this->dispatch('tweet-created', $tweet->id);
        $this->reset('tweet_content');
        $this->showModal = false;

        session()->flash('msg', 'tweet creado');
    }

    public function render()
    {
        return view('livewire.tweets.create-tweet');
    }
}
