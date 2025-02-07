<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class GeminiBotChatMessages extends Model
{

    protected $fillable = [
        'user_id',
        'message',
        'prompt'
    ];

    public static function saveMessage($userId, $result, $prompt)
    {
        try {
            GeminiBotChatMessages::create([
                'user_id' => $userId,
                'prompt' => $prompt,
                'message' => $result
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public static function listAllChatMessage($id){
        try {
            //code...
            $query = self::where(function($query) use ($id){
                $query->where('user_id', $id);
            })->orderBy('created_at', 'asc')
            ->get();
        } catch (\Throwable $th) {
            throw $th;
        }

        return $query;
    }

    public static function listLastChatMessage($id){
        // $query = self::where(function($query) use ($id){
        //     $query->where('user_id', $id);
        // })->orderBy('created_at', 'desc')
        // ->select('prompt', 'message')
        // ->first()
        // ->get();

        // return $query;

        // $query = self::where('user_id', $id)
        //     ->orderBy('created_at', 'desc')
        //     ->select('prompt', 'message')
        // ->get();

        // return $query;

        try {
            //code...
            $query = DB::select('SELECT prompt, message, id FROM gemini_bot_chat_messages where user_id = ?', [$id]);
        } catch (\Throwable $th) {
            throw $th;
        }

        return $query;
    }

    public static function deleteChatMessage($id){
        try {
            //code...
            $query = self::where(function($query) use ($id){
                $query->where('user_id', $id);
            })->delete();
        } catch (\Throwable $th) {
            throw $th;
        }

        return $query;
    }
}
