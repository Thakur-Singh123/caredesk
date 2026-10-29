<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SuperAdmin\AuthController as SuperAuthController;
use App\Http\Controllers\SuperAdmin\CompanyController;
use App\Http\Controllers\SuperAdmin\ProfileController as SuperProfileController;

Route::prefix('super-admin')->name('super.')->group(function () {
    // Guest Super Admin Login
    Route::middleware('guest')->group(function () {
        Route::get('/login', [SuperAuthController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [SuperAuthController::class, 'login'])->name('login.submit');
    });

    // Secured Super Admin Routes
    Route::middleware(['auth', 'role:super_admin'])->group(function () {
        Route::post('/logout', [SuperAuthController::class, 'logout'])->name('logout');

        Route::get('/dashboard', function () {
            return view('super-admin.dashboard');
        })->name('dashboard');

        Route::get('/profile', [SuperProfileController::class, 'edit'])->name('profile');
        Route::put('/profile', [SuperProfileController::class, 'update'])->name('profile.update');
        Route::put('/profile/password', [SuperProfileController::class, 'updatePassword'])->name('password.update');

        Route::resource('companies', CompanyController::class)->except(['create', 'show', 'edit']);
        Route::patch('companies/{company}/status', [CompanyController::class, 'toggleStatus'])->name('companies.status');
    });
});