<?php

use App\Http\Controllers\ChatRoom;
use App\Http\Controllers\GeminiIa;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/dashboard/chat/{id}', [ChatRoom::class, 'show'])->name('chat.room');
    Route::get('/dashboard/gemini', [GeminiIa::class, 'index'])->name('chat.gemini');
});
