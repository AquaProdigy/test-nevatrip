<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/order', [\App\Http\Controllers\OrderController::class, 'store'])
    ->name('order.store');
