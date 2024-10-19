<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;

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


    Route::get('/users/filter', [UserController::class, 'filter'])->name('users.filter');
    Route::resource('users', UserController::class)->parameters([
        'users' => 'user:email',
    ]);
    Route::get('/users/delete/{user:email}', [UserController::class, 'destroy'])->name('users.delete');
    Route::get('/users/status/{user}', [UserController::class, 'updateStatus'])->name('users.updateStatus');
});


require __DIR__.'/auth.php';