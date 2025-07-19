<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\admin\AdminController;

// Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');

// Redirect GET /login dan /register ke homepage karena pakai modal
Route::get('/login', function () {
    return redirect('/');
});
Route::get('/register', function () {
    return redirect('/');
});

// Tetap simpan POST login & register untuk pemrosesan
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected routes
Route::middleware(['auth'])->group(function () {
    Route::get('/booking', [BookingController::class, 'index'])->name('booking');
    Route::post('/booking', [BookingController::class, 'store']);
    Route::get('/jadwal', [JadwalController::class, 'index'])->name('jadwal');
    Route::delete('/booking/{id}', [BookingController::class, 'destroy'])->name('booking.destroy');
});

// Admin routes
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/revenue', [AdminController::class, 'revenue'])->name('admin.revenue');
    Route::get('/customers', [AdminController::class, 'customers'])->name('admin.customers');
});
