<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ConversationController;
use App\Http\Controllers\RideController;

// Route pour récupérer les messages d'une conversation
Route::get('/conversations/{conversationId}/messages', [ConversationController::class, 'allMessages']);
Route::get('/active-rides', [RideController::class, 'getActiveRides']);
