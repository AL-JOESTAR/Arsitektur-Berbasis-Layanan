<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminDoor;
use App\Http\Controllers\AdminKamarController;
use App\Http\Controllers\AdminLaporanController;
use App\Http\Controllers\DashboardRedirectController;
use App\Http\Controllers\DoorController;
use App\Http\Controllers\KamarController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\ParentController;
use App\Http\Controllers\PerpanjanganController;
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

Route::middleware(['auth', 'penyewa'])->group(function () {

Route::get('/dashboard', DashboardRedirectController::class)
    ->middleware(['auth'])
    ->name('dashboard');
});

Route::get('/home', [KamarController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


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
Route::middleware(['auth', 'admin'])->group(function () {

    //dashboard
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'dashboard'])
    ->middleware(['auth'])
    ->name('admin.dashboard');

    //laporan
    Route::get('/admin/laporan',[AdminLaporanController::class,'index']);

    Route::post('/admin/laporan/{id}',[AdminLaporanController::class,'update']);

    //kamar

    Route::get('/admin/kamar', [AdminKamarController::class,'adminKamar']);

    Route::post('/admin/kamar', [AdminKamarController::class,'store']);

    Route::get('/admin/kamar/{id}/edit', [AdminKamarController::class,'edit']);

    Route::put('/admin/kamar/{id}', [AdminKamarController::class,'update']);

    Route::delete('/admin/kamar/{id}', [AdminKamarController::class,'destroy']);

    Route::get('/admin/door-access', [AdminDoor::class,'index']);


});


//profile 

Route::middleware(['auth', 'penyewa'])->group(function () {
    Route::get('/dashboard', [ProfileController::class, 'index'])->name('dashboard');
    Route::resource('/parents', ParentController::class);

});

Route::middleware('auth')->group(function(){

    Route::get('/door-access',[DoorController::class,'index']);

    Route::get('/door-access/{reader}',
        [DoorController::class,'scan'])->name('door.scan');
});

// Perpanjangan
Route::get('/perpanjang/{id}',

[PerpanjanganController::class,'index'])

->name('perpanjang.index');

Route::post('/perpanjang/{id}',

[PerpanjanganController::class,'store'])

->name('perpanjang.store');