<?php

namespace App\Services;

use App\Models\GeminiBotChatMessages;
use Gemini as GlobalGemini;

class GeminiService
{
    public function GeminiGenerateText(string $prompt, $userId){

        $geminiClient = GlobalGemini::client(env('GEMINI_API_KEY'));

        $generatedContent  = $geminiClient->geminiPro()->generateContent($prompt);

        $formatedText = $generatedContent ->text();

        $GeminiBotChatMessages = new GeminiBotChatMessages();

        $messageSaved = $GeminiBotChatMessages->saveMessage($userId, $formatedText);

        return $formatedText;
    }
}
