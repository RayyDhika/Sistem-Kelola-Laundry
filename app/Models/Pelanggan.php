<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasFactory;

    // Memberitahu Laravel bahwa nama tabelnya adalah 'pelanggan' (bukan pelanggans)
    protected $table = 'pelanggan';

    // Penanda kolom yang BOLEH diisi (Mass Assignment)
    // Sesuaikan dengan nama di migration kamu
    protected $fillable = [
        'id_outlet',
        'nm_pelanggan',
        'jenis_kelamin',
        'no_telp',
        'alamat'
    ];

    public function outlet()
    {
        return $this->belongsTo(Outlet::class, 'id_outlet');
    }
}