<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\BranchController;
use App\Http\Controllers\Admin\PolicyImportController;

Route::prefix('admin')->name('admin.')->group(function () {
    // Guest Admin Login
    Route::middleware('guest')->group(function () {
        Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [AdminAuthController::class, 'login'])->name('login.submit');
    });

    // Secured Admin & Staff Routes
    Route::middleware(['auth', 'role:admin|staff'])->group(function () {
        Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');

        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');

        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile');
        Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('password.update');

        Route::resource('branches', BranchController::class)->except(['show', 'create', 'edit']);
        Route::patch('branches/{branch}/status', [BranchController::class, 'toggleStatus'])->name('branches.status');

        Route::get('/policies/import', [PolicyImportController::class, 'index'])->name('policies.import');
        Route::post('/policies/import', [PolicyImportController::class, 'store'])->name('policies.import.store');
    });
});