<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Outlet extends Model
{
    protected $table = 'outlet'; // Tetap 'outlet' tanpa 's'

    protected $fillable = [
        'nm_outlet', // Sesuaikan dari 'nama'
        'alamat',
        'no_telp',   // Sesuaikan dari 'tlp'
        'owner'      // Tambahkan kolom owner sesuai migration
    ];

    public function users()
    {
         return $this->hasMany(User::class, 'id_outlet');
    }
    

}