<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FI\AuthController as FIAuthController;
use App\Http\Controllers\FI\ProfileController;
use App\Http\Controllers\FI\DashboardController;

Route::prefix('fi')->name('fi.')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('/login', [FIAuthController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [FIAuthController::class, 'login'])->name('login.submit');
    });

    Route::middleware(['auth', 'role:field_inspector'])->group(function () {
        Route::post('/logout', [FIAuthController::class, 'logout'])->name('logout');
        
        //Profile
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile');
        Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('profile/image', [ProfileController::class, 'deleteImage'])->name('profile.image.delete');
        Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('password.update');

        //Dashboard
        Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    });
});