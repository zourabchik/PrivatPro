<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CardController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PaymentConfirmationController;
use App\Http\Controllers\CreditController;
use App\Http\Controllers\CreditConfirmationController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('auth')->group(function () {
    Route::get('me', [AuthController::class, 'me']);
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
});

Route::prefix('profile')->group(function () {
    Route::put('', [ProfileController::class, 'update']);
});

Route::prefix('users')->group(function () {
    Route::get('', [UserController::class, 'index']);
    Route::get('/{user}', [UserController::class, 'show']);
    Route::get('/{user}/cards', [CardController::class, 'byUser']);
    Route::get('/{user}/payments', [PaymentController::class, 'byUser']);
    Route::get('/{user}/payments/confirmations', [PaymentConfirmationController::class, 'byUser']);
    Route::get('/{user}/payments/{payment}/confirm', [PaymentConfirmationController::class, 'confirm']);
    Route::get('/{user}/credits', [CreditController::class, 'byUser']);
    Route::get('/{user}/credits/confirmations', [CreditConfirmationController::class, 'byUser']);
    Route::get('/{user}/credits/{credit}/confirm', [CreditConfirmationController::class, 'confirm']);
    Route::post('/{user}/credits', [CreditController::class, 'store']);
});

Route::prefix('payments')->group(function () {
    Route::post('', [PaymentController::class, 'store']);
});
