<?php

use App\Http\Controllers\API\Auth\AuthenticatedSessionController;
use App\Http\Controllers\API\Auth\PasswordController;
use App\Http\Controllers\API\ProfileController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\API\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\StepBasedMiddleware;

Route::middleware('guest:api')->group(function () {
    Route::post('register', [AuthenticatedSessionController::class, 'register'])->name('api.register');
    Route::post('login', [AuthenticatedSessionController::class, 'login'])->name('api.login');
    Route::post('verify-otp', [AuthenticatedSessionController::class, 'verifyOtp'])->name('api.verifyOtp');
    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])->name('api.password.email');
    Route::put('reset-password', [PasswordResetLinkController::class, 'update'])->name('api.password.reset');
});

Route::middleware('auth:api')->group(function () {
    Route::put('finalise', [AuthenticatedSessionController::class, 'finalise'])->name('api.finalise');
    Route::put('profile', [ProfileController::class, 'update'])->name('api.profile.update');
    Route::put('change-password', [PasswordController::class, 'update'])->name('api.password.update');
    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])->middleware('throttle:6,1')->name('api.verification.send');
    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store'])->name('api.password.confirm');
    Route::put('password', [PasswordController::class, 'update'])->name('api.password.update');
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('api.logout');
});
