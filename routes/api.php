<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('auth/register', [AuthController::class, 'register']);
Route::post('auth/login', [AuthController::class, 'login']);
Route::post('auth/password/forgot', [AuthController::class, 'forgot_password']);
Route::post('auth/password/reset', [AuthController::class, 'password_reset']);

Route::post('auth/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');