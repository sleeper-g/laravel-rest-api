<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TokenController;
use App\Http\Controllers\CarController;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::apiResource('cars', CarController::class);

});
Route::post('/tokens/create', [TokenController::class, 'create']);
