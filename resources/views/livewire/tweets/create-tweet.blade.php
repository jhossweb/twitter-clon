<div class ="max-w-xl mx-auto mt-6">
    @if(session()->has('msg'))
        <div class="bg-green-100 text-green-800 p-2 rounded mb-4">
            {{session('msg')}}
        </div>
    @endif

    <x-button wire:click.prevent.stop="createTweetModal">PUBLICAR</x-button>
    
    <form wire:submit.prevent="save">
        
            <x-dialog-modal wire:model="showModal" maxWidth="lg">
                <x-slot name="title">Crear Tweet</x-slot>
        
                <x-slot name="content">
                    <textarea wire:model.defer="tweet_content" class="w-full border rounded p-2" rows="3"></textarea>
                    @error('tweet_content') <span class="text-red-600">{{ $message }}</span> @enderror
        
                    <x-input type="file" wire:model="media" multiple class="mt-4" />
                    @error('media.*') <span class="text-red-600">{{ $message }} </span> @enderror


                    fda
                </x-slot>
        
                <x-slot name="footer">
                    <x-button>Guardar</x-button>
                    <x-button wire:click="$set('showModal', false)" class="ml-2">Cancelar</x-button>
                </x-slot>
            </x-dialog-modal>

    </form>
</div>
