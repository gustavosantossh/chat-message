<?php

namespace App\Services;

use Gemini as GlobalGemini;

class GeminiService
{
    public function GeminiGenerateText(string $prompt){
        $client = GlobalGemini::client(env('GEMINI_API_KEY'));

        $result = $client->geminiPro()->generateContent($prompt);

        return $result;
    }
}
