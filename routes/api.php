<?php

use App\Http\Controllers\Api\AggregatorController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/test', function (Request $request) { });

Route::post('/callback', [AggregatorController::class, 'callback']);
