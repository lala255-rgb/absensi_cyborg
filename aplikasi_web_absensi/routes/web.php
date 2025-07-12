<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\siswaController;
use App\Http\Controllers\absensiController;
use App\Http\Controllers\mentorController;
use App\Http\Controllers\Auth\AuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Public Routes (Guest only)
    Route::middleware('guest')->group(function () {
    Route::get('login', [AuthController::class, 'index'])->name('login');
    Route::post('post-login', [AuthController::class, 'postLogin'])->name('login.post');
    Route::get('registration', [AuthController::class, 'registration'])->name('register');
    Route::post('post-registration', [AuthController::class, 'postRegistration'])->name('register.post');
});

// Protected Routes (Authenticated users only)
Route::middleware('auth')->group(function () {
    // Dashboard
    Route::get('dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
    // Logout
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
    // Resource Routes
    Route::resource('siswas', siswaController::class);
    Route::resource('absensis', absensiController::class);
    Route::resource('mentors', mentorController::class);
    // Self Absensi Routes

    // Alternative self absensi routes (if needed)
    Route::get('absensis/self/form', [absensiController::class, 'selfAbsen'])->name('absensis.self.form');
    Route::post('absensis/self/submit', [absensiController::class, 'submitSelfAbsen'])->name('absensis.self.submit');
});

    Route::get('self-absen', [absensiController::class, 'selfAbsen'])->name('absensis.self');
    Route::post('self-absen', [absensiController::class, 'submitSelfAbsen'])->name('absensis.submitSelf');

// Default Routes
Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('dashboard');
    }
    return redirect()->route('login');
});
// Fallback route for undefined routes
Route::fallback(function () {
    return redirect()->route('login');
});