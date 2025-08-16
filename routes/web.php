<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;


Route::get('/', function () {
    return view('welcome');
});

// login routes
Route::get('login', [AuthController::class, 'showLogin'])->name('login');
Route::post('login', [AuthController::class, 'login']);

// registration routes
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// logout route
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

// dashboard
Route::middleware(['auth', 'role:admin'])->group(function() {
    Route::get('admin/dashboard', function() {
        return view('dashboard.admin');
    })->name('admin.dashboard');
});

Route::middleware(['auth', 'role:customer'])->group(function() {
    Route::get('customer/dashboard', function() {
        return view('dashboard.customer');
    })->name('customer.dashboard');
});