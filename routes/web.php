<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\TransaksiController; // Tambahkan ini

Route::get('/', function () {
    return view('welcome');
});

// LOGIN & LOGOUT
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// DASHBOARD
Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->middleware('auth')->name('dashboard');

// REGISTRASI PELANGGAN
// Cukup gunakan resource, ini sudah mencakup create, store, edit, dll.
Route::resource('pelanggan', PelangganController::class)->middleware('auth');

// ENTRI TRANSAKSI
Route::middleware('auth')->prefix('transaksi')->group(function () {
    // Halaman Utama (Tabel & Modal Tambah)
    Route::get('/', [TransaksiController::class, 'index'])->name('transaksi.index');
    
    // Proses Simpan Pesanan
    Route::post('/store', [TransaksiController::class, 'store'])->name('transaksi.store');
    
    // Fitur Hapus (Sesuai fungsionalitas yang diminta)
    Route::delete('/{id}', [TransaksiController::class, 'destroy'])->name('transaksi.destroy');
    
    // Fitur Cetak Nota (Membuka file nota.blade.php)
    Route::get('/{id}/cetak', [TransaksiController::class, 'cetak'])->name('transaksi.cetak');
    
    // Opsional: Jika ingin ada halaman edit tersendiri
    Route::get('/{id}/edit', [TransaksiController::class, 'edit'])->name('transaksi.edit');
    Route::put('/{id}', [TransaksiController::class, 'update'])->name('transaksi.update');
});