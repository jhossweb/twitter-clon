<div class ="max-w-xl mx-auto mt-6">
    @if(session()->has('msg'))
        <div class="bg-green-100 text-green-800 p-2 rounded mb-4">
            {{session('msg')}}
        </div>
    @endif

    <x-button wire:click="createTweetModal">PUBLICAR</x-button>

    <x-dialog-modal wire:model="showModal" maxWidth="lg">
        <x-slot name="title">Crear Tweet</x-slot>

        <x-slot name="content">
            <textarea wire:model.defer="tweet_content" class="w-full border rounded p-2" rows="3"></textarea>
            @error('tweet_content') <span class="text-red-600">{{ $message }}</span> @enderror
        </x-slot>

        <x-slot name="footer">
            <x-button wire:click="save">Guardar</x-button>
            <x-button wire:click="$set('showModal', false)" class="ml-2">Cancelar</x-button>
        </x-slot>
    </x-dialog-modal>
</div>
