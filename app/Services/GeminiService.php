<?php

namespace App\Services;

use Gemini as GlobalGemini;


class GeminiService
{
    public function GeminiGenerateText(){

        $geminiClient = new GlobalGemini();
        $geminiClient->client(env('GEMINI_API_KEY'));
        //$geminiClient = GlobalGemini::client(env('GEMINI_API_KEY'));

        return $geminiClient;
    }
}
