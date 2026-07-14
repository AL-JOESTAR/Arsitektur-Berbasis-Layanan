<?php

use App\Http\Controllers\AdminKamarController;
use App\Http\Controllers\AdminLaporanController;
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

Route::get('/kamar', [KamarController::class, 'kamarindex'])->middleware('auth');

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


//Admin
Route::middleware('auth')->group(function () {

    Route::get('/admin/laporan',[AdminLaporanController::class,'index']);

    Route::post('/admin/laporan/{id}',[AdminLaporanController::class,'update']);

});

Route::get('/admin/dashboard', function(){
    return view('dashboard_admin.dashboard');
});

Route::middleware('auth')->group(function () {

    Route::get('/admin/kamar', [AdminKamarController::class,'adminKamar']);

    Route::post('/admin/kamar', [AdminKamarController::class,'store']);

    Route::get('/admin/kamar/{id}/edit', [AdminKamarController::class,'edit']);

    Route::put('/admin/kamar/{id}', [AdminKamarController::class,'update']);

    Route::delete('/admin/kamar/{id}', [AdminKamarController::class,'destroy']);

});