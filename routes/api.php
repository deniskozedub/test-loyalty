<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\LoyaltyPointsController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

    // account auth

Route::prefix('auth')->middleware('auth:sanctum')->group(function (){
    Route::post('register', [AuthController::class, 'register'])->withoutMiddleware('auth:sanctum');
    Route::post('login', [AuthController::class, 'login'])->withoutMiddleware('auth:sanctum');
    Route::post('logout', [AuthController::class, 'logout']);
    // account management
    Route::post('account/create', [AccountController::class, 'create']);
    Route::post('account/activate/{type}/{id}', [AccountController::class, 'activate']);
    Route::post('account/deactivate/{type}/{id}', [AccountController::class, 'deactivate']);
    Route::get('account/balance/{type}/{id}', [AccountController::class, 'balance']);

    // loyalty points management
    Route::post('loyaltyPoints/deposit', [LoyaltyPointsController::class, 'deposit']);
    Route::post('loyaltyPoints/withdraw', [LoyaltyPointsController::class, 'withdraw']);
    Route::post('loyaltyPoints/cancel', [LoyaltyPointsController::class, 'cancel']);
});





