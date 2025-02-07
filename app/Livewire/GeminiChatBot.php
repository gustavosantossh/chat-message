<?php

namespace App\Livewire;

use App\Jobs\GenerateTextFromGeminiJob;
use App\Models\GeminiBotChatMessages;
use Livewire\Attributes\On;
use Livewire\Component;

class GeminiChatBot extends Component
{


    public $recentsMessageOnChat;
    public $promptInput;
    public $loading = false;
    public $messages = [];


    public function mount(){
        $this->messages = GeminiBotChatMessages::listAllChatMessage(auth()->guard()->user()->id);
    }


    public function getListeners() {
        return [
            'echo-private:Chat.Bot.' . auth()->guard()->user()->id . ',AvisaFrontGemini' => 'loadRecords'
        ];
    }

    public function loadRecords(){
        $this->loading = false;
        $this->messages =  GeminiBotChatMessages::listLastChatMessage(auth()->guard()->user()->id);
        $this->dispatch('messageUp');
    }

    public function formPromptSubmit(){
        $this->loading = true;

        $userId = auth()->guard()->id();

        GenerateTextFromGeminiJob::dispatch($userId, $this->promptInput)->onQueue('TextIa');

        $this->reset('promptInput');
    }

    public function deleteBotMessages() {
        $delete = GeminiBotChatMessages::deleteChatMessage(auth()->guard()->user()->id);

        if (!$delete){
            return redirect(route('dashboard'))->with('notFound', 'Ops, sistema indisponivel!');
        }
        return redirect(route('dashboard'))->with('success', 'Histórico apagado!');
    }

    public function render()
    {
        return view('livewire.gemini-chat-bot');
    }
}
