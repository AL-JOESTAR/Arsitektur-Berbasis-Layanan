<?php

use App\Http\Controllers\Api\DoorController;
use App\Http\Controllers\Api\FacilityController;
use App\Http\Controllers\Api\KamarController;
use App\Http\Controllers\Api\LaporanController;
use App\Http\Controllers\Api\PembayaranController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PenyewaanController;
use App\Http\Controllers\Api\MidtransController;
use App\Http\Controllers\Api\ReaderController;
use App\Http\Controllers\Api\TypeRoomController;
use App\Http\Controllers\PerpanjangController;

Route::prefix('penyewaans')->group(function () {
    Route::get('/penyewa/{penyewa_id}', [PenyewaanController::class, 'getByPenyewa']);

    Route::get('/', [PenyewaanController::class, 'index']);
    Route::post('/', [PenyewaanController::class, 'store']);
    Route::get('/{id}', [PenyewaanController::class, 'show']);
    Route::put('/{id}', [PenyewaanController::class, 'update']);
    Route::patch('/{id}', [PenyewaanController::class, 'update']);
    Route::delete('/{id}', [PenyewaanController::class, 'destroy']);
    
    Route::post('/{id}/perpanjang',
    [PenyewaanController::class,'perpanjang']);
});

Route::get('/pembayaran/{id}/snap-token', [PembayaranController::class, 'generateSnapToken']);

Route::get(
    '/pembayaran/penyewa/{penyewaId}',
    [PembayaranController::class, 'riwayatPenyewa']
);

Route::get('/kamar',[KamarController::class, 'index']);

Route::post('/midtrans/callback',[MidtransController::class,'notification']);

//Laporan 

Route::get('/laporan',[LaporanController::class,'index']);

Route::post('/laporan',[LaporanController::class,'store']);

Route::put('/laporan/{id}',[LaporanController::class,'update']);
Route::get('/laporan/penyewa/{id}', [LaporanController::class, 'getByPenyewa']);

//kamar

Route::get('/kamar/index', [KamarController::class, 'adminIndex']);
Route::post('/kamar', [KamarController::class, 'store']);
Route::get('/kamar/{id}', [KamarController::class, 'show']);
Route::put('/kamar/{id}', [KamarController::class, 'update']);
Route::delete('/kamar/{id}', [KamarController::class, 'destroy']);

// door access
Route::post('/door/validate', [DoorController::class,'validate']);
Route::get('/doorlogs/user/{id}',
    [DoorController::class,'user']);
Route::get('/readers',[ReaderController::class,'index']);

Route::get(
    '/admin/doorlogs',
    [DoorController::class,'admin']
);

Route::get('/admin/pembayaran', [PembayaranController::class,'admin']);
Route::get('/admin/riwayat-pembayaran',[PembayaranController::class,'riwayat']);

//facility

Route::get('/facilities',[FacilityController::class,'index']);

Route::post('/facilities',[FacilityController::class,'store']);

Route::put('/facilities/{id}',[FacilityController::class,'update']);

Route::delete('/facilities/{id}',[FacilityController::class,'destroy']);

//type room

Route::get('/type-room', [TypeRoomController::class,'index']);

Route::post('/type-room', [TypeRoomController::class,'store']);

Route::put('/type-room/{id}', [TypeRoomController::class,'update']);

Route::delete('/type-room/{id}', [TypeRoomController::class,'destroy']);


Route::get(
'/type-room/{id}/facilities',
[TypeRoomController::class,'facilities']
);

Route::post(
'/type-room/{id}/facilities',
[TypeRoomController::class,'saveFacilities']
);