<div>
    <button wire:click="toggleLike"
            class="text-sm flex items-center gap-1 {{ $liked ? 'text-red-500' : 'text-gray-500' }} hover:text-red-600 transition">
        ❤️ <span>{{ $likesCount }}</span>
    </button>
</div>
