<?php

namespace App\Livewire;

use App\Events\MessageSendEvent;
use App\Models\ChatRoom;
use App\Models\Message;
use App\Models\User;
use Livewire\Component;

class ChatUserRoom extends Component
{


    public $user;
    public $sender_id;
    public $receiver_id;
    public $messageInputModel;
    public $listAllMessages;
    public $chatRoomId;


    public function mount($user_id)
    {
        $this->sender_id = auth()->guard()->user()->id;
        $this->receiver_id = $user_id;

        $listAllMessages = Message::listAllMessages($this->sender_id, $this->receiver_id);

        foreach ($listAllMessages as $message) {
            $this->appendChatMessage($message);
        }

        $this->user = User::whereId($user_id)->first();
    }


    public function sendMessage()
    {

        $participantId = $this->receiver_id;

        // Encontra ou cria uma sala de chat entre os dois usuários
        $chatRoom = ChatRoom::findOrCreateChatRoom($this->sender_id, $participantId);

        $chatMessage = new Message();
        $chatMessage->sender_id = $this->sender_id;
        $chatMessage->receiver_id = $this->receiver_id;
        $chatMessage->message = $this->messageInputModel;
        $chatMessage->chat_room_id = $chatRoom->id;

        $chatMessage->save();

        $this->appendChatMessage($chatMessage);
        $this->chatRoomId = $chatRoom->id;

        // dd($chatMessage);
        broadcast(new MessageSendEvent($chatMessage))->toOthers();

        $this->reset('messageInputModel');
    }

    public function listenerForMessage($event)
    {
        // dd($event);
        $chatMessage = Message::listNewMessages($event);
        $this->appendChatMessage($chatMessage);
    }

    public function appendChatMessage($message)
    {
        $this->listAllMessages[] = [
            'id' => $message->id,
            'message' => $message->message,
            'sender' => $message->sender->name,
            'receiver' => $message->receiver->name,
        ];
    }

    public function getListeners()
    {
        return [
            "echo-private:chat.channel.1,MessageSendEvent" => 'listenerForMessage',
        ];
    }

    public function render()
    {
        return view('livewire.chat-user-room');
    }
}
