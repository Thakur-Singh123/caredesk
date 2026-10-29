<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\PublicCompanyRegisterController;
use App\Http\Controllers\Admin\AuthController as AdminAuthController;

// Public Welcome Route
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Public Company Registration
Route::get('/register-company', [PublicCompanyRegisterController::class, 'showRegistrationForm'])->name('company.register');
Route::post('/register-company', [PublicCompanyRegisterController::class, 'register'])->name('company.register.submit');

// Universal Logout Route
Route::post('/logout', [AdminAuthController::class, 'logout'])->name('universal.logout');