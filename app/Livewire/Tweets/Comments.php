<?php

namespace App\Livewire\Tweets;

use App\Models\Tweet;
use App\Models\TweetComments;
use Livewire\Component;

class Comments extends Component
{

    public Tweet $tweet;

    public int $tweetId;
    public bool $showModalComment = false;
    public $comment_content = "";

    public int $commentsCount;



    function openFormComment() {
        $this->showModalComment = true;
    }

    public function mount(int $tweetId)
    {
        $this->tweetId = $tweetId;
        $this->tweet = Tweet::findOrFail($tweetId);
        $this->commentsCount = $this->tweet->comments_count;
    }
    

    public function save()
    {
        $this->validate([
            'comment_content' => 'required|string|max:280',
        ]);

        TweetComments::create([
            'user_id' => auth()->id(),
            'tweet_id' => $this->tweetId,
            'comment_content' => $this->comment_content,
        ]);

        $this->tweet->increment('comments_count');
        $this->commentsCount = $this->tweet->comments_count;

        $this->reset('comment_content', 'showModalComment');
    }


    public function render()
    {
        return <<<'HTML'
        <div>

            <button wire:click.prevent.stop="openFormComment" class="hover:text-blue-500 flex items-center gap-1">
                        
                💬 <span> {{ $this->tweet->comments_count }} </span>
            </button>

            <x-dialog-modal wire:model="showModalComment" maxWidth="lg">
                <x-slot name="title">Comentario </x-slot>

                <x-slot name="content">
                    <textarea wire:model.defer="comment_content" class="w-full border rounded p-2" rows="3"></textarea>
                    @error('comment_content') <span class="text-red-600">{{ $message }}</span> @enderror
                </x-slot>

                <x-slot name="footer">
                    <x-button wire:click="save">Guardar</x-button>
                    <x-button wire:click="$set('showModalComment', false)" class="ml-2">Cancelar</x-button>
                </x-slot>
            </x-dialog-modal>
        </div>
        HTML;
    }
}
