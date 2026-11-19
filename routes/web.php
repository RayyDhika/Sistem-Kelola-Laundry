<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\OutletController;
use App\Http\Controllers\PaketController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LaporanController;

// =========================
// HALAMAN AWAL
// =========================
Route::get('/', function () {
    return view('welcome');
});

// =========================
// LOGIN
// =========================
Route::get('/login', [AuthController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');

Route::post('/profil/update-foto', [UserController::class, 'updateFoto'])
    ->middleware('auth')
    ->name('profil.update');


// ====================================================
// ADMIN
// ====================================================
Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // DATA MASTER
    Route::resource('outlet', OutletController::class);
    Route::resource('paket', PaketController::class);

    // USER
    Route::get('/user', [UserController::class, 'index'])
        ->name('user.index');

    Route::post('/user', [UserController::class, 'store'])
        ->name('user.store');

    Route::put('/user/{id}', [UserController::class, 'update'])
        ->name('user.update');

    Route::delete('/user/{id}', [UserController::class, 'destroy'])
        ->name('user.destroy');

    // LAPORAN
    Route::get('/laporan', [LaporanController::class, 'index'])
        ->name('laporan.index');

    Route::get('/laporan/cetak', [LaporanController::class, 'cetak'])
        ->name('laporan.cetak');
});


// ====================================================
// KASIR
// ====================================================
Route::middleware(['auth', 'role:kasir'])->group(function () {

    Route::get('/kasir', [DashboardController::class, 'index'])
        ->name('kasir.dashboard');

    Route::get('/kasir/pelanggan', [PelangganController::class, 'index'])
        ->name('kasir.pelanggan');

    Route::get('/kasir/transaksi', [TransaksiController::class, 'index'])
        ->name('kasir.transaksi');

    Route::get('/kasir/laporan', [LaporanController::class, 'kasirIndex'])
        ->name('kasir.laporan');

    Route::get('/kasir/laporan/cetak', [LaporanController::class, 'kasirCetak'])
        ->name('kasir.laporan.cetak');
});


// ====================================================
// OWNER
// ====================================================
Route::middleware(['auth', 'role:owner'])->group(function () {

    Route::get('/owner', [LaporanController::class, 'ownerIndex'])
        ->name('owner.dashboard');

    Route::get('/owner/laporan/cetak', [LaporanController::class, 'ownerCetak'])
        ->name('owner.laporan.cetak');
});

Route::middleware(['auth', 'role:admin|kasir'])->group(function () {

    Route::resource('pelanggan', PelangganController::class);

    Route::resource('transaksi', TransaksiController::class);

    Route::get('/transaksi/{id}/nota', [TransaksiController::class, 'nota'])
        ->name('transaksi.nota');

});