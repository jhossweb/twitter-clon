
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
            
            <div class="max-w-2xl mx-auto">
                <div class="flex items-center justify-between ">
                    <h1 class="text-2xl font-bold">{{ $user->name }}</h1>
                    
                    <img src="{{ $user->avatar_url ?? 'https://ui-avatars.com/api/?name=' . urlencode($user->name) }}"
                         alt="Avatar"
                         class="w-150 h-150 rounded-full object-fill hover:opacity-80 transition">
                </div>
                
                <div class=" py-5">
                    <span> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid perferendis ex eligendi fuga excepturi debitis sunt! Similique vitae dolore maiores officia laboriosam, totam, nemo asperiores impedit esse eligendi repudiandae quo? </span>
                </div>
                
                <div class="py-5 ">

                    <p class="text-sm"> {{ $user->followers }} followers · {{ $user->following }} following</p>
                </div>

                <div class="py-2 flex justify-center p-4">
                    <x-button class="mx-auto"> Edit Profile </x-button>
                </div>

            </div>
        </div>
    </div>

    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="max-w-2xl mx-auto">
                   
               
    
                        <livewire:tweets.get-tweets :user="$user" />

              

                </div>
            </div>
        </div>
    </div>

</div>

