<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenjualanItem extends Model
{
    use HasFactory;

    protected $table = 'penjualan_item';

    protected $fillable = [
        'id_penjualan',
        'id_barang',
        'id_stok',
        'id_warna',
        'no_rangka',
        'no_mesin',
        'harga',
    ];

    

    public function penjualan()
    {
        return $this->belongsTo(Penjualan::class, 'id_penjualan');
    }

    public function stok()
    {
        return $this->belongsTo(Stok::class, 'id_stok');
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang');
    }
}
