<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\OutletController;
use App\Http\Controllers\PaketController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LaporanController;
use Illuminate\Support\Facades\Auth;

// =====================================================
// HALAMAN AWAL
// =====================================================
Route::get('/', function () {
    return view('welcome');
});

// =====================================================
// AUTH
// =====================================================
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// =====================================================
// ROUTE SETELAH LOGIN (WAJIB LOGIN)
// =====================================================
Route::middleware('auth')->group(function () {

    // DASHBOARD
    Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard');

    // DATA MASTER (Menggunakan resource agar semua fungsi CRUD aktif)
    Route::resource('outlet', OutletController::class);
    Route::resource('pelanggan', PelangganController::class);
    Route::resource('paket', PaketController::class);

    //user 
    Route::get('/user', [UserController::class, 'index'])->name('user.index');

    Route::post('/user', [UserController::class, 'store'])->name('user.store');

    Route::put('/user/{id}', [UserController::class, 'update'])->name('user.update');

    Route::delete('/user/{id}', [UserController::class, 'destroy'])->name('user.destroy');
    // =====================================================
    // TRANSAKSI
    // =====================================================
    // Menggunakan resource penuh supaya tombol Tambah (create) 
    // dan tombol Lihat (show) berfungsi tanpa error
    Route::resource('transaksi', TransaksiController::class);
    
    // Rute cetak nota (kustom)
    Route::get('/transaksi/{id}/cetak', [TransaksiController::class, 'cetak'])
        ->name('transaksi.cetak');

    Route::get('/transaksi/{id}/nota',
        [TransaksiController::class, 'nota'])
        ->name('transaksi.nota');

    // =====================================================
    // LAPORAN
    // =====================================================
    Route::get('/laporan', [LaporanController::class, 'index'])
        ->name('laporan.index');


    Route::get('/laporan/cetak', [LaporanController::class, 'cetak'])
        ->name('laporan.cetak');

    //logout
    Route::post('/logout', function () {

        Auth::logout();

        return redirect('/login');

    })->name('logout');
    
});

Route::middleware('auth')->group(function(){

    Route::get('/kasir', function () {
        return view('kasir.dashboard');
    })->name('kasir.dashboard');

});

Route::middleware(['auth'])->group(function(){

    // =========================
    // KASIR
    // =========================
    Route::get('/kasir', function () {
        return view('kasir.dashboard');
    })->name('kasir.dashboard');

    Route::get('/kasir/pelanggan',
        [PelangganController::class, 'index'])
        ->name('kasir.pelanggan');

    Route::get('/kasir/transaksi',
        [TransaksiController::class, 'index'])
        ->name('kasir.transaksi');

    Route::get('/kasir/laporan',
        [LaporanController::class, 'index'])
        ->name('kasir.laporan');

    Route::get('/kasir/laporan/cetak',
        [LaporanController::class, 'cetak'])
        ->name('kasir.laporan.cetak');


    // =========================
    // OWNER
    // =========================
    Route::get('/owner',
        [LaporanController::class, 'index'])
        ->name('owner.dashboard');

    Route::get('/owner/laporan/cetak',
        [LaporanController::class, 'cetak'])
        ->name('owner.laporan.cetak');

});

