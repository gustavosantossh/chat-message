<?php

namespace App\Livewire;

use App\Jobs\GenerateTextFromGeminiJob;
use App\Services\GeminiService;
use Livewire\Component;

class GeminiChatBot extends Component
{


    public $recentsMessageOnChat;
    public $promptInput;

    public function formPromptSubmit(){

        GenerateTextFromGeminiJob::dispatch($this->promptInput)->onQueue('TextIa');

        $this->reset('promptInput');
    }

    // public function getListeners()
    // {
    //     return [
    //         "echo-private:Chat.ia.channel,TextGenerated" => 'formPromptSubmit',
    //     ];
    // }



    public function render()
    {
        return view('livewire.gemini-chat-bot');
    }
}
