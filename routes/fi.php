<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FI\AuthController as FIAuthController;

Route::prefix('fi')->name('fi.')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('/login', [FIAuthController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [FIAuthController::class, 'login'])->name('login.submit');
    });

    Route::middleware(['auth', 'role:field_inspector'])->group(function () {
        Route::post('/logout', [FIAuthController::class, 'logout'])->name('logout');
        Route::get('/dashboard', fn() => view('fi.dashboard'))->name('dashboard');
    });
});