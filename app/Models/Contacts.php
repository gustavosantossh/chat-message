<?php

namespace App\Models;

use Illuminate\Container\Attributes\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB as FacadesDB;

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

        if (!$contactAlreadyExists) {

            $this->storeContact($userId, $idContact);
            $this->storeContact($idContact, $userId);

            return session()->flash('success', 'Contato Adicionado com sucesso!');
        }

        return session()->flash('AlreadyExists', 'Contato já cadastrado!');
    }

    public function contactAlreadyExists($userId, $contactId)
    {
        return self::where(function ($query) use ($userId, $contactId) {
            $query->where('id_user', $userId)
                ->where('id_contact', $contactId);
        })->orWhere(function ($query) use ($userId, $contactId) {
            $query->where('id_user', $contactId)
                ->where('id_contact', $userId);
        })
            ->exists();
    }

    private function storeContact($userId, $idContact)
    {
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

    public static function filterContacts($searchContacts, $userId)
    {

        $query = FacadesDB::select('SELECT * FROM users inner join contacts ON contacts.id_contact = users.id where contacts.id_user = ? and users.name LIKE ?', [$userId, '%' . $searchContacts . '%']);

        return $query;
    }

    public static function listContacts($userId)
    {
        return FacadesDB::select('SELECT * FROM users INNER JOIN contacts ON users.id = contacts.id_contact WHERE contacts.id_user = ?', [$userId]);
    }
}
