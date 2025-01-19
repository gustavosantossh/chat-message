<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    //
    public function sender(){
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function receiver(){
        return $this->belongsTo(User::class, 'receiver_id');
    }

    public function chatRoom()
    {
        return $this->belongsTo(ChatRoom::class);
    }


    /**
     * @param mixed $sender_id
     * @param mixed $user_id
     *
     * @return [type]
     */
    public static function listAllMessages($sender_id, $receiverId){
        return self::where(function($query) use ($sender_id, $receiverId){
            $query->where('sender_id', $sender_id)
                ->where('receiver_id', $receiverId);
        })->orWhere(function($query) use ($sender_id, $receiverId) {
            $query->where('sender_id', $receiverId)
                ->where('receiver_id', $sender_id);
        })
        ->orderBy('created_at', 'asc')
        ->with('sender:id,name', 'receiver:id,name')
        ->get();
    }

    public static function listNewMessages($event){
        return self::whereId($event['message']['id'])
        ->with('sender:id,name', 'receiver:id,name')
        ->first();
    }

    public static function deleteContactMessages($senderId, $receiverId){
        return self::where(function($query) use ($senderId, $receiverId){
            $query->where('sender_id', $senderId)
            ->where('receiver_id', $receiverId);

        })->orWhere(function($query) use ($senderId, $receiverId){
            $query->where('sender_id', $receiverId)
            ->where('receiver_id', $senderId);

        })->delete();
    }


}
