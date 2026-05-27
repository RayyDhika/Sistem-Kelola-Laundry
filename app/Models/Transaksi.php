<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\DetailTransaksi;
class Transaksi extends Model
{
    use HasFactory;

    // Menghubungkan model ke nama tabel transaksi di database
    protected $table = 'transaksi';
    
    // Mendaftarkan nama kolom database yang diizinkan untuk diisi massal
    protected $fillable = [
        'id_outlet', 
        'id_user',
        'kode_invoice', 
        'id_pelanggan', 
        'tgl_masuk',     
        'batas_waktu', 
        'tgl_bayar', 
        'diskon', 
        'pajak', 
        'total_harga',   
        'status', 
        'status_bayar',  
        'id_user'
    ];

    /**
     * Relasi belongsTo ke model Pelanggan
     */
    public function pelanggan() {
        return $this->belongsTo(Pelanggan::class, 'id_pelanggan');
    }

    /**
     * Relasi belongsTo ke model Outlet
     */
    public function outlet() {
        return $this->belongsTo(Outlet::class, 'id_outlet');
    }

    public function user() {
        return $this->belongsTo(User::class, 'id_user');
    }   

    public function details()
    {
        return $this->hasMany(DetailTransaksi::class, 'id_transaksi');
    }
}