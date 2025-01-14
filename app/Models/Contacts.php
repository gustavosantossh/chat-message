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

        $contactAlreadyExists = Contacts::where('id_user', $userId)->where('id_contact', $idContact)->exists();

        if(!$contactAlreadyExists){
            $createContact = Contacts::create([
                'id_user' => $userId,
                'id_contact' => $idContact
            ]);

            session()->flash('success', 'Contato Adicionado com sucesso!');
        }


    }

    public function deleteContact($idContact)
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
