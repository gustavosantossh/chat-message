<?php

namespace App\Jobs;

use App\Events\TextGenerated;
use App\Services\GeminiService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class GenerateTextFromGeminiJob implements ShouldQueue
{
    use Queueable;


    public $promptInput;
    /**
     * Create a new job instance.
     */
    public function __construct(string $promptInput)
    {
        $this->promptInput = $promptInput;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $generateText = new GeminiService();

        $result = $generateText->GeminiGenerateText($this->promptInput);

        broadcast(new TextGenerated($result))->toOthers();
    }
}
