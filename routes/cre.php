<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CRE\AuthController as CREAuthController;
use App\Http\Controllers\CRE\ProfileController;
use App\Http\Controllers\CRE\DashboardController;

Route::prefix('cre')->name('cre.')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('/login', [CREAuthController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [CREAuthController::class, 'login'])->name('login.submit');
    });

    Route::middleware(['auth', 'role:cre'])->group(function () {
        Route::post('/logout', [CREAuthController::class, 'logout'])->name('logout');

        //Profile
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile');
        Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('profile/image', [ProfileController::class, 'deleteImage'])->name('profile.image.delete');
        Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('password.update');

        //Dashboard
        Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    });
});