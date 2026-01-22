<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;

// Redirect /home ke /
Route::redirect('/home', '/');

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/barang-temuan', [ItemController::class, 'index'])->name('items.index');
Route::get('/barang-temuan/{item}', [ItemController::class, 'show'])->name('items.show');

// Auth Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected Routes (harus login)
Route::middleware('auth')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/profile', [DashboardController::class, 'profile'])->name('dashboard.profile');
    Route::post('/dashboard/profile', [DashboardController::class, 'updateProfile'])->name('dashboard.profile.update');
    Route::get('/dashboard/points', [DashboardController::class, 'points'])->name('dashboard.points');
    
    // Report Items
    Route::get('/lapor-barang', [ItemController::class, 'create'])->name('items.create');
    Route::post('/lapor-barang', [ItemController::class, 'store'])->name('items.store');
    
    // Claim Items
    Route::post('/barang-temuan/{item}/claim', [ItemController::class, 'claim'])->name('items.claim');
});