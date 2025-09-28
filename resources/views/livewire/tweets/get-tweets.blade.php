<div  class="space-y-6 max-w-xl mx-auto mt-6">
    @foreach($this->tweets as $tweet)
        <div wire:key="tweet-{{ $tweet->id }}" class="flex gap-3 p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition">
            {{-- Avatar --}}
            <img src="{{ $tweet->user->avatar_url ?? 'https://ui-avatars.com/api/?name=' . urlencode($tweet->user->name) }}" 
                 alt="Avatar" 
                 class="w-10 h-10 rounded-full object-cover">

            {{-- Contenido --}}
            <div class="flex-1">
                {{-- Encabezado --}}
                <div class="flex items-center gap-2 text-sm">
                    <span class="font-semibold text-gray-900">{{ $tweet->user->name }}</span>
                    {{-- <span class="text-gray-500">@{{ $tweet->user->user }}</span> --}}
                    <span class="text-gray-400">· {{ $tweet->created_at->diffForHumans() }}</span>
                </div>

                {{-- Texto del tweet --}}
                <p class="mt-1 text-gray-800 text-[15px] leading-snug">
                    {{ $tweet->tweet_content }}
                </p>

                {{-- Acciones --}}
                <div class="flex gap-6 mt-3 text-gray-500 text-sm">
                    <button class="hover:text-blue-500 flex items-center gap-1">
                        💬 <span> {{ $tweet->comments_count }} </span>
                    </button>
                    <button class="hover:text-green-500 flex items-center gap-1">
                        🔁 <span> {{ $tweet->retweets_count }} </span>
                    </button>

                
                    <livewire:tweets.like :likeable="$tweet" :wire:key="'tweet-like-'.$tweet->id" />


                </div>
            </div>
        </div>
    @endforeach
</div>
