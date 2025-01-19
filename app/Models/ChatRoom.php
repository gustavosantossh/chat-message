<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatRoom extends Model


{

    protected $fillable = [
        'first_user_id',
        'second_user_id',
    ];

    public function messages()
    {
        return $this->belongsTo(Message::class);
    }
    // CREATE A PRIVATE CHAT ROOM BETWEEN TWO USERS
    // CRIA UMA SALA DE CHAT PRIVADA ENTRE DOIS USUARIOS

    public static function startChat($participantId)
    {
        $loggedUserId = auth()->guard()->user()->id;

        $chatRoom = self::where(function ($query) use ($loggedUserId, $participantId) {
            $query->where('first_user_id', $loggedUserId)->where('second_user_id', $participantId);
        })->orWhere(function ($query) use ($loggedUserId, $participantId) {
            $query->where('first_user_id', $loggedUserId)->where('second_user_id', $participantId);
        })->first();

        if (!$chatRoom) {
            $chatRoom = self::create([
                'first_user_id' => $loggedUserId,
                'second_user_id' => $participantId,
            ]);
            return $chatRoom->id;
        }

        return $chatRoom->id;
    }

    public static function findOrCreateChatRoom($loggedUserId, $participantId)
    {
        $chatRoom = ChatRoom::firstOrCreate([
            'first_user_id' => min($loggedUserId, $participantId),
            'second_user_id' => max($loggedUserId, $participantId),
        ]);

        return $chatRoom;
    }
}
