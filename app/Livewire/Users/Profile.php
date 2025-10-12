<?php

namespace App\Livewire\Users;

use App\Models\User;
use Livewire\Component;

class Profile extends Component
{
    public User $user;

    function mount(User $user)
    {
        $this->user = $user->load(['tweets', 'followers', 'following']);
    }



    public function render()
    {
        return view('livewire.users.profile');
    }
}
