<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\Admin\ServiceController;
use App\Http\Controllers\Api\Admin\BookingController;
use App\Http\Controllers\Api\ServiceListController;
use App\Http\Controllers\Api\BookingListController;


// public 
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login',    [AuthController::class, 'login']);

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::middleware(['auth:sanctum', 'is_admin'])->group(function () {
    // Services API
    Route::post('/services', [ServiceController::class, 'store']);
    Route::put('/services/{id}', [ServiceController::class, 'update']);
    Route::delete('/services/{id}', [ServiceController::class, 'destroy']);

    // Bookings API 
    Route::get('/admin/bookings', [BookingController::class, 'index']);
});

Route::middleware('auth:sanctum')->group(function() {
    Route::post('/logout', [AuthController::class, 'logout']);

    // Customers can view services
    Route::get('/services', [ServiceListController::class, 'index']);

    // Customers can book services
    Route::post('/bookings', [BookingListController::class, 'store']);

    // Customers can view their own bookings
    Route::get('/bookings', [BookingListController::class, 'index']);
});
