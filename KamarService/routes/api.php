<?php

use App\Http\Controllers\Api\KamarController;
use App\Http\Controllers\Api\LaporanController;
use App\Http\Controllers\Api\PembayaranController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PenyewaanController;
use App\Http\Controllers\Api\MidtransController;

Route::prefix('penyewaans')->group(function () {
    Route::get('/penyewa/{penyewa_id}', [PenyewaanController::class, 'getByPenyewa']);

    Route::get('/', [PenyewaanController::class, 'index']);
    Route::post('/', [PenyewaanController::class, 'store']);
    Route::get('/{id}', [PenyewaanController::class, 'show']);
    Route::put('/{id}', [PenyewaanController::class, 'update']);
    Route::patch('/{id}', [PenyewaanController::class, 'update']);
    Route::delete('/{id}', [PenyewaanController::class, 'destroy']);
});

Route::get('/pembayaran/{id}/snap-token', [PembayaranController::class, 'generateSnapToken']);

Route::get('/kamar',[KamarController::class, 'index']);

Route::post('/midtrans/callback',[MidtransController::class,'notification']);

//Laporan 

Route::get('/laporan',[LaporanController::class,'index']);

Route::post('/laporan',[LaporanController::class,'store']);

Route::put('/laporan/{id}',[LaporanController::class,'update']);