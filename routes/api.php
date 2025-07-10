<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PersonController;


Route::post('/login', [AuthController::class, 'login']);

Route::get('/test-api', function () {
    return response()->json(['message' => 'API is alive']);
});

Route::prefix('persons')->group(function () {
    Route::get('/', [PersonController::class, 'index']);
    Route::get('/{id}', [PersonController::class, 'show']);
    Route::post('/', [PersonController::class, 'store']);
    Route::put('/{id}', [PersonController::class, 'update']);
}); 