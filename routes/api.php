<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PersonController;
use App\Http\Controllers\Api\EmployeeController;

Route::post('/login', [AuthController::class, 'login']);

Route::get('/test-api', function () {
    return response()->json(['message' => 'API is alive']);
});

Route::prefix('persons')->group(function () {
    Route::get('/', [PersonController::class, 'index']);
    Route::get('/{id}', [PersonController::class, 'show']);
    Route::post('/', [PersonController::class, 'store']);
    Route::put('/{id}', [PersonController::class, 'update']);
    Route::apiResource('users', App\Http\Controllers\Api\UserController::class);
});

// ✅ These are outside the prefix so they match Flutter:
Route::get('/employees', [EmployeeController::class, 'index']);
Route::post('/employees', [EmployeeController::class, 'store']); // ✅ ADD THIS
