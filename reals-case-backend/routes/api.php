<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AffiliatesController;
use App\Http\Controllers\CommissionController;
use App\Http\Controllers\AuthController;

// Route::get('/test', function (Request $request) {
//     return "Hello World!";
// });

Route::prefix('user')->controller(UserController::class)->group(function () {
    route::get('/', 'index')->middleware('auth:sanctum');
    route::get('/{id}', 'show')->middleware('auth:sanctum');
    route::post('/', 'store')->middleware('auth:sanctum');
    route::put('/{id}', 'update')->middleware('auth:sanctum');
    route::delete('/{id}', 'destroy')->middleware('auth:sanctum');
});

Route::prefix('affiliate')->controller(AffiliatesController::class)->group(function () {
    route::get('/', 'index')->middleware('auth:sanctum');
    route::get('/{id}', 'show')->middleware('auth:sanctum');
    route::post('/', 'store')->middleware('auth:sanctum');
    route::put('/{id}', 'update')->middleware('auth:sanctum');
    route::delete('/{id}', 'destroy')->middleware('auth:sanctum');
});

Route::prefix('commission')->controller(CommissionController::class)->group(function () {
    route::get('/', 'index')->middleware('auth:sanctum');
    route::get('/{id}', 'show')->middleware('auth:sanctum');
    route::post('/', 'store')->middleware('auth:sanctum');
    route::put('/{id}', 'update')->middleware('auth:sanctum');
    route::delete('/{id}', 'destroy')->middleware('auth:sanctum');
});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');