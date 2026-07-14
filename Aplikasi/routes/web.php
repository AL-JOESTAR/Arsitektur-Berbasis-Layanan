<?php

use App\Http\Controllers\DashboardRedirectController;
use App\Http\Controllers\KamarController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QrController;
use App\Http\Middleware\QrMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard', DashboardRedirectController::class)
    ->middleware(['auth'])
    ->name('dashboard');

Route::get('/home', [KamarController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/dashboard/qr',[QrController::class, 'index'])->middleware(QrMiddleware::class);

require __DIR__.'/auth.php';

Route::get('/kamar', function(){
    return view('dashboard.kamar');
})->middleware('auth');

Route::get('/laporan', function(){
    return view('dashboard.laporan');
})->middleware('auth');
Route::get('/pembayaran', function(){
    return view('dashboard.pembayaran');
})->middleware('auth');

Route::post('/sewa', [KamarController::class, 'sewa'])
    ->middleware('auth');

Route::middleware('auth')->group(function () {

    Route::get('/laporan', [LaporanController::class,'index']);

    Route::post('/laporan', [LaporanController::class,'store']);

});