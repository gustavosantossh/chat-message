<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class GeminiBotChatMessages extends Model
{

    protected $fillable = [
        'user_id',
        'message',
        'prompt'
    ];

    public static function saveMessage($userId, $result, $prompt)
    {
        GeminiBotChatMessages::create([
            'user_id' => $userId,
            'prompt' => $prompt,
            'message' => $result
        ]);
    }

    public static function listAllChatMessage($id){
        return self::where(function($query) use ($id){
            $query->where('user_id', $id);
        })->orderBy('created_at', 'asc')
        ->get();
    }

    public static function listLastChatMessage($id){
        return self::where(function($query) use ($id){
            $query->where('user_id', $id);
        })->orderBy('created_at', 'desc')
        ->select('prompt', 'message')
        ->first()
        ->get();
    }

    public static function deleteChatMessage($id){
        return self::where(function($query) use ($id){
            $query->where('user_id', $id);
        })->delete();
    }
}
