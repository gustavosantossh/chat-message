<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contacts extends Model
{
    /** @use HasFactory<\Database\Factories\ContactsFactory> */
    use HasFactory;

    protected $fillable = [
        'id_user',
        'id_contact'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'contacts', 'id_contact', 'id_user');
    }

    public function createContact($idContact)
    {

        $userId = auth()->guard()->id();

        $contactAlreadyExists = $this->contactAlreadyExists($userId, $idContact);

        if(!$contactAlreadyExists){

            $this->storeContact($userId, $idContact);
            $this->storeContact($idContact, $userId);

            // $createContact = Contacts::create([
            //     'id_user' => $userId,
            //     'id_contact' => $idContact
            // ]);

            // $createContact = Contacts::create([
            //     'id_user' => $idContact,
            //     'id_contact' => $userId
            // ]);

            return session()->flash('success', 'Contato Adicionado com sucesso!');
        }

        return session()->flash('AlreadyExists', 'Contato já cadastrado!');


    }

    public function contactAlreadyExists($userId, $contactId){
        return self::where(function($query) use ($userId, $contactId){
            $query->where('id_user', $userId)
                    ->where('id_contact', $contactId);
        })->orWhere(function($query) use ($userId, $contactId){
            $query->where('id_user', $contactId)
                    ->where('id_contact', $userId);
        })
        ->exists();
    }

    private function storeContact($userId, $idContact){
        self::create([
            'id_user' => $userId,
            'id_contact' => $idContact
        ]);
    }

    public static function deleteContact($idContact)
    {

        $userId = auth()->guard()->id();

        $deleteUser = self::where(function ($query) use ($userId, $idContact) {
            $query->where('id_user', $userId)
                ->where('id_contact', $idContact);
        })->orWhere(function ($query) use ($userId, $idContact) {
            $query->where('id_user', $idContact)
                ->where('id_contact', $userId);
        })->delete();

    }
}
