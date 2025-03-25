<?php

namespace App\Jobs;

use App\Events\AvisaFrontGemini;
use App\Models\GeminiBotChatMessages;
use Gemini;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Parsedown;
use Throwable;

class GenerateTextFromGeminiJob implements ShouldQueue
{
    use Queueable, Dispatchable, InteractsWithQueue, SerializesModels;


    public int $userId;
    public string $promptInput;
    /**
     * Create a new job instance.
     */
    public function __construct($userId, string $promptInput)
    {
        $this->promptInput = $promptInput;
        $this->userId = $userId;

    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {

            // Client Configs
            $geminiClient = Gemini::client("YOUR GEMINI CLIENT CODE");

            // Generate Content
            $generatedContent  = $geminiClient->geminiPro()->generateContent($this->promptInput);
            $formatedText = $generatedContent->text();

            // Process parsedown
            $parsedown = new Parsedown();
            $finalText = $parsedown->text($formatedText);

            // Save as BD
            $GeminiBotChatMessages = new GeminiBotChatMessages();
            $messageSaved = $GeminiBotChatMessages->saveMessage($this->userId, $finalText, $this->promptInput);

            // Dispatch event
           // event(new AvisaFrontGemini($this->userId, $finalText));
            AvisaFrontGemini::dispatch($this->userId, $finalText);


        } catch (\Throwable $th) {

            Log::error('Gemini Job Failed', [
                'userId' => $this->userId,
                'prompt' => $this->promptInput,
                'error' => $th->getMessage(),
                'trace' => $th->getTraceAsString()
            ]);

            $this->fail($th);
            throw $th;
        }


    }
}
