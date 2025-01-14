<?php

namespace App\Livewire;

use App\Models\Contacts;
use App\Models\User;
use Livewire\Component;

class ListUsersChat extends Component
{
    public $contacts;
    public $searchContacts;


    public function mount(){

        $userId = auth()->guard()->user()->id;

        $this->contacts = User::with('UserHasContacts')->find($userId);

    }

    public function AdicionarContato($email){
        $findUserByEmail = User::where('email', $email)->exists();

        if(!$findUserByEmail){
            dd('falseaa');
        }

        $getIdUserContactByAdded = User::where('email', $email)->pluck('id')->first();

        $contactsModel = new Contacts();

        $contactsModel->createContact($getIdUserContactByAdded);


    }

    public function deleteContact($id){

        $contact = new Contacts();

        $contact->deleteContact($id);

    }

    public function render()
    {
        return view('livewire.list-users-chat');
    }
}
