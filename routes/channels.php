<?php

use App\Models\ChatRoom;
use App\Models\User;
use Illuminate\Support\Facades\Broadcast;
use phpDocumentor\Reflection\PseudoTypes\False_;

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('chat.channel.{chatRoomId}', function (User $user, $chatRoomId) {
    return ChatRoom::where('id', $chatRoomId)
    ->where(function ($query) use ($user) {
        $query->where('first_user_id', $user->id)
        ->orWhere('second_user_id', $user->id);
    })
    ->exists();
});


Broadcast::channel('Chat.ia.channel', function () {
    return true;
});
