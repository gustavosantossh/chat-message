<?php

namespace App\Livewire;

use App\Jobs\GenerateTextFromGeminiJob;
use App\Services\GeminiService;
use Gemini;
use Livewire\Component;

class GeminiChatBot extends Component
{


    public $recentsMessageOnChat;
    public $promptInput;

    public function formPromptSubmit(){
        $userId = auth()->guard()->id();

        GenerateTextFromGeminiJob::dispatch($userId, $this->promptInput)->onQueue('TextIa');

        $this->reset('promptInput');
    }

    public function render()
    {
        return view('livewire.gemini-chat-bot');
    }
}
