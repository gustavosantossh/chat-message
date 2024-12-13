<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class ListUsersChat extends Component
{
    public $listUsersChat;


    public function mount(){
        $userId = auth()->guard()->user()->id;
        $this->listUsersChat = User::where('id','!=', $userId)->get();
        // dd($this->listUsersChat);
    }
    public function render()
    {
        return view('livewire.list-users-chat');
    }
}
