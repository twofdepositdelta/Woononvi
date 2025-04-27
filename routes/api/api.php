<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\CountryController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\VehicleController;
use App\Http\Controllers\API\ConversationController;
use App\Http\Controllers\API\DocumentController;
use App\Http\Controllers\API\PaymentController;
use App\Http\Controllers\API\RideController;
use App\Http\Controllers\API\ActualityController;

require __DIR__ . '/auth_api.php';

Route::middleware('guest:api')->group(function () {
    Route::get('countries', [CountryController::class, 'index'])->name('api.countries.index');
});

Route::middleware('auth:api')->group(function () {
    Route::get('conversations/messages', [ConversationController::class, 'index'])->name('api.conversation.get');
    Route::post('conversations/message', [ConversationController::class, 'store'])->name('api.conversation.store');
    Route::post('conversations/message/support', [ConversationController::class, 'storeForSupport'])->name('api.conversation.storeForSupport');

    Route::post('users/change-role', [UserController::class, 'changeUserRole'])->name('api.user.changeUserRole');
    Route::post('users/become-driver', [UserController::class, 'becomeDriver'])->name('api.user.becomeDriver');
    Route::get('users/notices', [UserController::class, 'getNotices'])->name('api.user.notices');

    Route::get('drivers/vehicles', [VehicleController::class, 'getUserVehicles'])->name('api.vehicle.get');
    Route::get('drivers/vehicles/get-types', [VehicleController::class, 'getVehicleTypes'])->name('api.vehicle.getTypes');
    Route::get('drivers/vehicles/get-documents-types', [DocumentController::class, 'getDocumentTypes'])->name('api.vehicle.getDocumentTypes');
    Route::post('drivers/vehicles/store', [VehicleController::class, 'store'])->name('api.vehicle.store');
    Route::post('drivers/vehicles/edit', [VehicleController::class, 'update'])->name('api.vehicle.update');
    Route::post('drivers/documents/store', [DocumentController::class, 'store'])->name('api.document.store');
    Route::delete('drivers/vehicles/documents/destroy', [DocumentController::class, 'destroy'])->name('api.document.destroy');
    
    Route::post('payments/recharge-balance', [PaymentController::class, 'rechargeBalance'])->name('api.user.rechargeBalance');
    Route::get('payments/get-status/{reference}', [PaymentController::class, 'checkTransactionStatus'])->name('api.user.rechargeBalance');
    
    Route::post('rides/store', [RideController::class, 'store'])->name('api.ride.store');
    Route::post('rides/get', [RideController::class, 'getRides'])->name('api.ride.index');
    Route::post('rides/search', [RideController::class, 'searchRides'])->name('api.ride.search');
    Route::post('rides/booking', [RideController::class, 'bookRide'])->name('api.ride.book');
    Route::post('rides/reservations', [RideController::class, 'getReservations'])->name('api.ride.reservations');
    Route::post('rides/bookings', [RideController::class, 'getDriverBookings'])->name('api.ride.getDriverBookings');
    Route::post('rides/bookings/passenger', [RideController::class, 'getPassengerBookings'])->name('api.ride.getPassengerBookings');
    Route::post('rides/bookings/updateBookingStatus', [RideController::class, 'updateBookingStatus'])->name('api.ride.updateBookingStatus');
    Route::post('rides/calculateRidePrice', [RideController::class, 'calculateRidePrice'])->name('api.rides.calculateRidePrice');

    Route::get('actualities/index', [ActualityController::class, 'index'])->name('api.actualities.index');

    Route::get('settings/kms', [RideController::class, 'getKms'])->name('api.settings.kms');
});