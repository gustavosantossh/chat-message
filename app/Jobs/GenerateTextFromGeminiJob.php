<?php

namespace App\Jobs;

use App\Models\GeminiBotChatMessages;
use App\Services\GeminiService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Cache;

class GenerateTextFromGeminiJob implements ShouldQueue
{
    use Queueable;


    public $promptInput;
    public $userId;
    /**
     * Create a new job instance.
     */
    public function __construct(string $promptInput, $userId)
    {
        $this->promptInput = $promptInput;
        $this->userId = $userId;

    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $generateText = new GeminiService();

        $result = $generateText->GeminiGenerateText($this->promptInput, $this->userId);

    }
}
