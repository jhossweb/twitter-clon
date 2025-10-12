
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            
            <div class="max-w-2xl mx-auto">
                <h1 class="text-2xl font-bold">{{ $user->name }}</h1>
                <p class="text-gray-600">@{{ $user->username }}</p>
                <textarea cols="30" rows="10"> {{ $user->profile->bio }} </textarea>
                
                <p> {{ $user->followers }} followers · {{ $user->following }} following</p>
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

