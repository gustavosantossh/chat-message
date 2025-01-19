<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class GeminiBotChatMessages extends Model
{

    protected $fillable = [
        'user_id',
        'message',
    ];

    public static function saveMessage($userId, $result)
    {

        dd('cheguei ate aqui!', $userId, $result);
        GeminiBotChatMessages::create([
            'user_id' => $userId,
            'message' => $result
        ]);
    }
}
