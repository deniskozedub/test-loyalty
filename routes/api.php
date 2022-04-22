<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\LoyaltyPointsController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

    // account auth

Route::middleware('auth:sanctum')->group(function (){
    // auth user
    Route::prefix('auth')->group(function (){
        Route::post('register', [AuthController::class, 'register'])->withoutMiddleware('auth:sanctum');
        Route::post('login', [AuthController::class, 'login'])->withoutMiddleware('auth:sanctum');
        Route::post('logout', [AuthController::class, 'logout']);
    });
    // account management
    Route::prefix('account')->group(function (){
        Route::post('store', [AccountController::class, 'store']);
        Route::post('change-status/{type}/{id}', [AccountController::class, 'changeStatus']);
        Route::get('balance/{type}/{id}', [AccountController::class, 'balance']);
    });

    // loyalty points management
    Route::post('loyaltyPoints/deposit', [LoyaltyPointsController::class, 'deposit']);
    Route::post('loyaltyPoints/withdraw', [LoyaltyPointsController::class, 'withdraw']);
    Route::post('loyaltyPoints/cancel', [LoyaltyPointsController::class, 'cancel']);
});





