<?php

use App\Http\Controllers\Api\LaporanController;
use Illuminate\Support\Facades\Route;

Route::apiResource('laporans', LaporanController::class);

Route::get('/laporans', [LaporanController::class, 'index']);
Route::post('/laporans', [LaporanController::class, 'store']);
Route::get('/laporans/{id}', [LaporanController::class, 'show']);
Route::put('/laporans/{id}', [LaporanController::class, 'update']);
Route::delete('/laporans/{id}', [LaporanController::class, 'destroy']);