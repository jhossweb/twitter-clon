<?php

namespace App\Livewire\Tweets;

use Illuminate\Database\Eloquent\Model;
use Livewire\Attributes\On;
use Livewire\Component;

class Like extends Component
{
    public Model $likeable;
    public bool $liked = false;
    public int $likesCount = 0;

    public function mount(Model $likeable)
    {
        $this->likeable = $likeable;
        $this->likesCount = $likeable->likes_count;
        
        if(auth()->check()) 
        {
            if($likeable->relationLoaded('likes')) {
                $this->liked = $likeable->likes->contains('user_id', auth()->id());
            } else {
                $this->liked = $likeable->likes()->where('user_id', auth()->id())->exists();
            }
        }
    }

    #[On('tweet-created')]
    public function toggleLike()
    {
        $user = auth()->user();

        $existing = $this->likeable->likes()->where('user_id', $user->id)->first();

        if ($existing) {
            $existing->delete();
            $this->likeable->decrement('likes_count');
            $this->liked = false;
        } else {
            $this->likeable->likes()->create(['user_id' => $user->id]);
            $this->likeable->increment('likes_count');
            $this->liked = true;
        }

        $this->likesCount = $this->likeable->likes_count;
    }


    public function render()
    {
        return view('livewire.tweets.like');
    }
}
