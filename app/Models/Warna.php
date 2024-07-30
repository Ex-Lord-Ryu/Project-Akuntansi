<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warna extends Model
{
    use HasFactory;

    protected $table = 'warna';
    public $incrementing = false; // Menonaktifkan auto increment
    protected $keyType = 'string'; // Menentukan bahwa primary key adalah string

    protected $fillable = [
        'id',
        'warna'
    ];


    public function pembelianItems()
    {
        return $this->hasMany(PembelianItem::class, 'id_warna');
    }

    public function penjualanItems()
    {
        return $this->hasMany(PenjualanItem::class, 'id_warna');
    }

    public function barang()
    {
        return $this->hasMany(Barang::class, 'id_warna');
    }

    public function stoks()
    {
        return $this->hasMany(Stok::class, 'id_warna');
    }

    public function stokTerjuals()
    {
        return $this->hasMany(StokTerjual::class, 'id_warna');
    }
}
