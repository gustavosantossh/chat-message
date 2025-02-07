<?php

namespace App\Livewire;

use App\Models\Contacts;
use App\Models\User;
use Livewire\Component;

class ListUsersChat extends Component
{
    public $userId;
    public $contacts;
    public $searchContacts = '';
    public $selectedContactId;
    public $selectedChatBot;
    public $chatType;

    public function mount(){

        $this->userId = auth()->guard()->user()->id;

        $this->contacts = Contacts::listContacts($this->userId);
        // $this->contacts = User::with('UserHasContacts')->find($this->userId);

    }

    public function AdicionarContato($email){
        $findUserByEmail = User::where('email', $email)->exists();

        if(!$findUserByEmail){
            return session()->flash('notFound', 'Usuário não encontrado!');
        }

        $getIdUserContactByAdded = User::where('email', $email)->pluck('id')->first();

        $contactsModel = new Contacts();

        $contactsModel->createContact($getIdUserContactByAdded);

        $this->updateContacts();

    }

    public function selectContact($contactId){
        $this->selectedContactId = $contactId;
        $this->chatType = 'user';
    }

    public function selectChatBot($botChat){
        $this->chatType = $botChat;

    }

    public function updateContacts(){
        $this->contacts = Contacts::filterContacts($this->searchContacts, auth()->guard()->user()->id);
    }

    public function render()
    {
        return view('livewire.list-users-chat');
    }
}
