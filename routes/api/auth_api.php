<?php

use App\Http\Controllers\API\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\PasswordController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest:api')->group(function () {
    Route::post('register', [AuthenticatedSessionController::class, 'register'])->name('api.register');
    Route::post('login', [AuthenticatedSessionController::class, 'login'])->name('api.login');
    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])->name('api.password.email');
    // Route::post('reset-password', [NewPasswordController::class, 'store'])->name('api.password.store');
});

Route::middleware('auth:api')->group(function () {
    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])->middleware('throttle:6,1')->name('api.verification.send');
    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store'])->name('api.password.confirm');
    Route::put('password', [PasswordController::class, 'update'])->name('api.password.update');
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('api.logout');
});
