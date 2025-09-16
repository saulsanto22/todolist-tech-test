<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/todos', [App\Http\Controllers\Api\TodoController::class,'store']);
Route::get('/todos/export', [App\Http\Controllers\Api\TodoExportController::class, 'export']);
Route::get('/chart', [App\Http\Controllers\Api\ChartController::class, 'index']);
