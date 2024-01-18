<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group(['prefix' => 'v1'], function () {

    Route::group(['prefix' => 'auth'], function () {
        Route::post('/token', [AuthController::class, 'generateAccessToken']);
        Route::post('/register', [AuthController::class, 'registerNewUser']);
        Route::delete('/token', [AuthController::class, 'revokeAccessToken'])->middleware('auth:sanctum');
    });


});
