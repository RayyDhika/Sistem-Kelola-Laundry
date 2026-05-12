<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paket extends Model
{
    use HasFactory;

    protected $fillable = ['id_outlet', 'jenis','nm_paket', 'harga'];

    // Relasi ke Detail Transaksi
    public function details()
    {
        return $this->hasMany(DetailTransaksi::class, 'id_paket');
    }
}