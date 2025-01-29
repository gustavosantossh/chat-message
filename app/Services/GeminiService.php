<?php

namespace App\Services;

use App\Events\newMessageBot;
use App\Models\GeminiBotChatMessages;
use Gemini as GlobalGemini;
use Parsedown;

class GeminiService
{
    public function GeminiGenerateText(string $prompt, $userId){

        $geminiClient = GlobalGemini::client(env('GEMINI_API_KEY'));

        $generatedContent  = $geminiClient->geminiPro()->generateContent($prompt);

        $formatedText = $generatedContent->text();

        $parsedown = new Parsedown();

        $finalText = $parsedown->text($formatedText);

        $GeminiBotChatMessages = new GeminiBotChatMessages();

        $messageSaved = $GeminiBotChatMessages->saveMessage($userId, $finalText, $prompt);

        return $finalText;
    }
}
