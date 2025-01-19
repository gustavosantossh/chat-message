<?php

namespace App\Livewire;

use App\Events\MessageSendEvent;
use App\Models\ChatRoom;
use App\Models\Contacts;
use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Crypt;
use Livewire\Attributes\Reactive;
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

        $getChatRomId = ChatRoom::findOrCreateChatRoom($this->sender_id, $this->receiver_id);
        $this->chatRoomId = $getChatRomId->id;

    }

    public function sendMessage()
    {

        // PEGA O ID DO PARTICIPANTE DO CHAT
        $participantId = $this->receiver_id;

        // Encontra ou cria uma sala de chat entre os dois usuários
        $chatRoom = ChatRoom::findOrCreateChatRoom($this->sender_id, $participantId);

        // ISTANCIA A MENSAGEM DO CHAT
        $chatMessage = new Message();
        $chatMessage->sender_id = $this->sender_id;
        $chatMessage->receiver_id = $this->receiver_id;
        $chatMessage->message = Crypt::encryptString($this->messageInputModel);
        $chatMessage->chat_room_id = $chatRoom->id;

        // SALVA A MENSAGEM NO BANCO DE DADOS
        $chatMessage->save();

        // ADICIONA A MENSAGEM AO CHAT
        $this->appendChatMessage($chatMessage);


        // dd($chatRoom->id);
        broadcast(new MessageSendEvent($chatMessage))->toOthers();

        $this->reset('messageInputModel');

        $this->dispatch('scroll-bottom');

    }

    public function listenerForMessage($event)
    {
        $chatMessage = Message::listNewMessages($event);
        $this->appendChatMessage($chatMessage);
    }

    public function appendChatMessage($message)
    {
        $decryptedMessage = Crypt::decryptString($message->message);

        $this->listAllMessages[] = [
            'id' => $message->id,
            'message' => $decryptedMessage,
            'sender' => $message->sender->name,
            'receiver' => $message->receiver->name,
            'created_at' => $message->created_at->format('H:i'),
        ];
    }

    public function getListeners()
    {
        return [
            "echo-private:chat.channel.{$this->chatRoomId},MessageSendEvent" => 'listenerForMessage',
        ];
    }

    public function deleteContact($id){

        try {

            $userId = auth()->guard()->user()->id;

            $contact = Contacts::deleteContact($id);

            $messages = Message::deleteContactMessages($userId, $id);

            return redirect(route('dashboard'))->with('success', 'Contato deletado! :)');

        } catch (\Throwable $th) {

            return redirect(route('dashboard'))->with('error', 'Error, não conseguimos apagar :( ');
        }

    }

    public function render()
    {
        return view('livewire.chat-user-room');
    }
}
