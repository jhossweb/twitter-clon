<div>
    @foreach($this->tweets as $tweet)
        <div class="max-w-xl mx-auto mt-6 p-4 border rounded">
            <p>{{ $tweet->tweet_content }}</p>
            <span class="text-sm text-gray-500">Publicado el {{ $tweet->created_at->format('d/m/Y H:i') }}</span>
        </div>
    @endforeach
</div>
