<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StokTerjual extends Model
{
    use HasFactory;

    protected $table = 'stok_terjual';

    protected $fillable = [
        'id_stok',
        'id_barang',
        'id_warna',
        'no_rangka',
        'no_mesin',
        'harga'
    ];

    public function penjualanItem() {
        return $this->hasMany(PenjualanItem::class, 'id_stok');
    }

    public function stok()
    {
        return $this->belongsTo(Stok::class, 'id_stok');
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang');
    }

    public function warna()
    {
        return $this->belongsTo(Warna::class, 'id_warna');
    }
}
