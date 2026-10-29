<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Operations\AuthController as OpsAuthController;

Route::prefix('operations')->name('ops.')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('/login', [OpsAuthController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [OpsAuthController::class, 'login'])->name('login.submit');
    });

    Route::middleware(['auth', 'role:operations'])->group(function () {
        Route::post('/logout', [OpsAuthController::class, 'logout'])->name('logout');
        Route::get('/dashboard', fn() => view('operations.dashboard'))->name('dashboard');
    });
});