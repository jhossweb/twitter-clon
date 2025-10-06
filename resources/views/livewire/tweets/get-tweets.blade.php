<div class="space-y-6 max-w-xl mx-auto mt-6">
    @foreach($this->tweets as $tweet)
        <a href="{{ route('tweet.show', $tweet->id) }}" wire:key="tweet-{{ $tweet->id }}" class="flex gap-3 p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition">
            {{-- Avatar --}}
            <img src="{{ $tweet->user->avatar_url ?? 'https://ui-avatars.com/api/?name=' . urlencode($tweet->user->name) }}"
                 alt="Avatar"
                 class="w-10 h-10 rounded-full object-cover">

            {{-- Contenido --}}
            <div class="flex-1">
                <div class="flex items-center gap-2 text-sm">
                    <span class="font-semibold text-gray-900">{{ $tweet->user->name }}</span>
                    <span class="text-gray-400">· {{ $tweet->created_at->diffForHumans() }}</span>
                </div>

                <p class="mt-1 text-gray-800 text-[15px] leading-snug">
                    {{ $tweet->tweet_content }}
                </p>

                {{-- Imágenes tipo Facebook --}}
                @php
                    $media = $tweet->media;
                    $count = $media->count();
                @endphp

                @if($count === 1)
                    <div class="mt-3">
                        <img src="{{ Storage::url($media[0]->image_url) }}"
                             alt="Tweet media"
                             class="rounded-lg w-full max-h-96 object-cover border border-gray-200"
                             loading="lazy" />
                    </div>
                @elseif($count === 2)
                    <div class="mt-3 grid grid-cols-2 gap-2">
                        @foreach($media as $image)
                            <img src="{{ Storage::url($image->image_url) }}"
                                 alt="Tweet media"
                                 loading="lazy"
                                 class="rounded-lg w-full max-h-64 object-cover border border-gray-200" />
                        @endforeach
                    </div>
                @elseif($count > 2)
                    <div class="mt-3 grid grid-cols-3 gap-2">
                        <div class="col-span-2">
                            <img src="{{ Storage::url($media[0]->image_url) }}"
                                 alt="Tweet media"
                                 loading="lazy"
                                 class="rounded-lg w-full max-h-96 object-cover border border-gray-200" />
                        </div>
                        <div class="relative">
                            <img src="{{ Storage::url($media[1]->image_url) }}"
                                 alt="Tweet media"
                                 loading="lazy"
                                 class="rounded-lg w-full h-full max-h-96 object-cover border border-gray-200" />
                            @if($count > 2)
                                <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center text-white text-xl font-bold rounded-lg">
                                    +{{ $count - 2 }}
                                </div>
                            @endif
                        </div>
                    </div>
                @endif

                {{-- Acciones --}}
                <div class="flex gap-6 mt-3 text-gray-500 text-sm z-10 relative">
                    <livewire:tweets.comments lazy :tweetId="$tweet->id" :wire:key="'comment-'.$tweet->id" class="cursor-auto"/>
                    <button class="hover:text-green-500 flex items-center gap-1">
                        🔁 <span> {{ $tweet->retweets_count }} </span>
                    </button>
                    <livewire:tweets.like lazy :likeable="$tweet" :wire:key="'tweet-like-'.$tweet->id" />
                </div>
            </div>
        </a>
    @endforeach

    {{-- Scroll infinito --}}
    @if ($this->hasMorePages)
        <div 
            x-data="{}"
            x-intersect="$wire.loadMore()"
            class="py-4 text-center text-gray-500"
        >
            Cargando más tweets...
        </div>
    @else
        <div class="py-4 text-center text-gray-400">
            No hay más tweets que mostrar.
        </div>
    @endif
</div>