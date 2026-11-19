<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksi';

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
    ];

    // =========================
    // RELASI PELANGGAN
    // =========================
    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'id_pelanggan');
    }

    // =========================
    // RELASI OUTLET
    // =========================
    public function outlet()
    {
        return $this->belongsTo(Outlet::class, 'id_outlet');
    }

    // =========================
    // RELASI USER
    // =========================
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    // =========================
    // RELASI DETAIL TRANSAKSI
    // =========================
    public function details()
    {
        return $this->hasMany(DetailTransaksi::class, 'id_transaksi');
    }

    public function paket()
    {
        return $this->belongsTo(Paket::class, 'id_paket');
    }
}