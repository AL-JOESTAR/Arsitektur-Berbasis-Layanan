<?php

use App\Http\Controllers\Api\PembayaranController;
use Illuminate\Support\Facades\Route;


Route::post('/pembayaran', [PembayaranController::class, 'store']);