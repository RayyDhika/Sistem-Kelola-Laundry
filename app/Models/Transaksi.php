<?php
class Transaksi extends Model
{
    protected $fillable = ['id_pelanggan', 'tgl', 'batas_waktu', 'status', 'dibayar', 'id_user'];

    public function pelanggan() {
        return $this->belongsTo(Pelanggan::class, 'id_pelanggan');
    }

    public function details() {
        return $this->hasMany(DetailTransaksi::class, 'id_transaksi');
    }
}