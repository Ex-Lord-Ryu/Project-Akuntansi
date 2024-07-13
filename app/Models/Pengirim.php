<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengirim extends Model
{
    use HasFactory;

    protected $table = 'pengirims'; // Pastikan nama tabel benar

    protected $fillable = [
        'jenis',
    ];

    public function pembelians()
    {
        return $this->hasMany(Pembelian::class, 'id_pengirim');
    }

    public function penjualans()
    {
        return $this->hasMany(Penjualan::class, 'id_pengirim');
    }
}


