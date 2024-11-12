<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\CountryController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\VehicleController;
use App\Http\Controllers\API\ConversationController;

require __DIR__ . '/auth_api.php';

Route::middleware('guest:api')->group(function () {
    Route::get('countries', [CountryController::class, 'index'])->name('api.countries.index');
});

Route::middleware('auth:api')->group(function () {
    Route::get('conversations/messages', [ConversationController::class, 'index'])->name('api.conversation.get');
    Route::post('conversations/message', [ConversationController::class, 'store'])->name('api.conversation.store');
    Route::post('conversations/message/support', [ConversationController::class, 'storeForSupport'])->name('api.conversation.storeForSupport');

    Route::post('users/change-role', [UserController::class, 'changeUserRole'])->name('api.user.changeUserRole');

    Route::get('drivers/vehicles', [VehicleController::class, 'getUserVehicles'])->name('api.vehicle.get');
    Route::get('drivers/vehicles/get-types', [VehicleController::class, 'getVehicleTypes'])->name('api.vehicle.getTypes');
    Route::post('drivers/vehicles/store', [VehicleController::class, 'store'])->name('api.vehicle.store');
    Route::put('drivers/vehicles/edit', [VehicleController::class, 'update'])->name('api.vehicle.update');
});