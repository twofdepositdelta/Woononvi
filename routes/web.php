<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RideController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TypeNewController;
use App\Http\Controllers\ActualityController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RideRequestController;
use App\Http\Controllers\MessageController;

Route::get('/', [HomeController::class, 'index'])->name('index');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/profile/avatar/update', [ProfileController::class, 'updateAvatar'])->name('profile.avatar.update');
    Route::put('/notification/settings', [ProfileController::class, 'updateNotificationSettings'])->name('notification.settings.update');

    // User
    Route::get('/check-username', [UserController::class, 'checkUsername'])->name('check.username');
    // Settings
    Route::get('/settings/edit', [DashboardController::class, 'setting'])->name('settings');
    Route::put('/settings/update', [DashboardController::class, 'update'])->name('settings.update');
    Route::get('/city', [DashboardController::class, 'city'])->name('setting.city');
    Route::get('/countries/update/{country}', [DashboardController::class, 'countryStatus'])->name('country.updatestatus');

    Route::get('/cities/update/{city}', [DashboardController::class, 'cityStatus'])->name('city.updatestatus');

    Route::get('/filter-cities', [DashboardController::class, 'filterCitiesByCountry'])->name('filter.cities');


    Route::get('/apis/edit/', [ApiController::class, 'api'])->name('apis');
    Route::put('/apis/update/', [ApiController::class, 'update'])->name('apis.update');


    Route::get('/users/filter', [UserController::class, 'filter'])->name('users.filter');

    Route::get('/demande/create', [RideRequestController::class, 'create'])->name('ride_requests.create');
    Route::post('/demande/edit', [RideRequestController::class, 'store'])->name('ride_requests.store');
    Route::get('/demande/liste', [RideRequestController::class, 'index'])->name('ride_requests.index');
    Route::get('/demande/detail', [RideRequestController::class, 'show'])->name('ride_requests.show');
    Route::get('/demande/{rideRequest}/{status}', [RideRequestController::class, 'updatestatus'])->name('ride_requests.status');
    Route::get('/demande/historique', [RideRequestController::class, 'historique'])->name('ride_requests.historique');

    Route::resource('users', UserController::class)->parameters([
        'users' => 'user:email',
    ]);

    Route::resource('typenews', TypeNewController::class)->parameters([
        'typenews' => 'typenew:slug',
    ]);

    Route::resource('actualities', ActualityController::class)->parameters([
        'actualities' => 'actuality:slug',
    ]);

    Route::resource('rides', RideController::class)->parameters([
        'rides' => 'ride',
    ]);
    Route::get('/trajet/historique', [RideController::class, 'historique'])->name('rides.historique');
    Route::get('/trajet/{ride}/{status}', [RideController::class, 'updatestatus'])->name('rides.status');

    Route::get('/users/delete/{user:email}', [UserController::class, 'destroy'])->name('users.delete');
    Route::get('/users/status/{user}', [UserController::class, 'updateStatus'])->name('users.updateStatus');
    Route::get('/users/certified/{user}', [UserController::class, 'updateIsCertified'])->name('users.updateIsCertified');
    Route::get('/conversations/{id}/messages', [ChatController::class, 'fetchMessages']);

    Route::get('/support/chat/conversation', [ChatController::class, 'fetchMessages'])->name('chat.fetchMessages');
});


require __DIR__.'/auth.php';
