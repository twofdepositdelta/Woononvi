<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\CountryController;
use App\Http\Controllers\API\ConversationController;

require __DIR__.'/auth_api.php';

Route::middleware('guest:api')->group(function () {
    Route::get('countries', [CountryController::class, 'index'])->name('api.countries.index');
});

Route::middleware('auth:api')->group(function () {
    Route::get('conversations/messages', [ConversationController::class, 'index'])->name('api.conversation.get');
    Route::post('conversations/message', [ConversationController::class, 'store'])->name('api.conversation.store');
});