<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AdminController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login',    [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {

    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::post('/logout', [AuthController::class, 'logout']);

    // Client
    Route::post('/orders',             [OrderController::class, 'store']);
    Route::get('/mes-commandes',       [OrderController::class, 'myOrders']);
    Route::post('/orders/{id}/cancel', [OrderController::class, 'cancel']);

    // Employé
    Route::middleware('employe')->group(function () {
        Route::post('/orders/{id}/prepare', [OrderController::class, 'prepare']);
    });

    // Admin
    Route::middleware('admin')->group(function () {
        Route::get('/admin/dashboard', [AdminController::class, 'dashboard']);
    });

});