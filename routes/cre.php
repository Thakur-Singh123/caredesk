<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CRE\AuthController as CREAuthController;

Route::prefix('cre')->name('cre.')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('/login', [CREAuthController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [CREAuthController::class, 'login'])->name('login.submit');
    });

    Route::middleware(['auth', 'role:cre'])->group(function () {
        Route::post('/logout', [CREAuthController::class, 'logout'])->name('logout');
        Route::get('/dashboard', fn() => view('cre.dashboard'))->name('dashboard');
    });
});