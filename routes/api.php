<?php

use App\Http\Controllers\Api\AggregatorController;
use App\Http\Controllers\Api\Auth\AuthenticatedAdminSessionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/test', function (Request $request) { });

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/callback', [AggregatorController::class, 'callback']);
});

Route::post('/login', [AuthenticatedAdminSessionController::class, 'store']);
