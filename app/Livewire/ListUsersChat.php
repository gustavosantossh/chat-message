<?php

namespace App\Livewire;

use App\Models\Contacts;
use App\Models\User;
use Livewire\Component;

class ListUsersChat extends Component
{
    public $contacts;
    public $searchContacts;
    public $selectedContactId;
    public $selectedChatBot;

    public function mount(){

        $userId = auth()->guard()->user()->id;

        $this->contacts = User::with('UserHasContacts')->find($userId);


    }

    public function AdicionarContato($email){
        $findUserByEmail = User::where('email', $email)->exists();

        if(!$findUserByEmail){
            return session()->flash('notFound', 'Usuário não encontrado!');
        }

        $getIdUserContactByAdded = User::where('email', $email)->pluck('id')->first();

        $contactsModel = new Contacts();

        $contactsModel->createContact($getIdUserContactByAdded);

    }


    public function selectContact($contactId){
        $this->selectedContactId = $contactId;
    }

    public function selectChatBot($bot){
        $this->selectedChatBot = $bot;
    }

    public function render()
    {
        return view('livewire.list-users-chat');
    }
}
