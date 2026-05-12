<?php

class DetailTransaksi extends Model
{
    protected $fillable = ['id_transaksi', 'id_paket', 'qty'];

    public function paket() {
        return $this->belongsTo(Paket::class, 'id_paket');
    }
}
