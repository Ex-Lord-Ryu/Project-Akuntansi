<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PembelianItem extends Model
{
    use HasFactory;

    protected $table = 'pembelian_item';

    protected $fillable = [
        'id_pembelian',
        'id_barang',
        'id_warna',
        'no_rangka',
        'no_mesin',
        'harga'
    ];

    public function pembelian()
    {
        return $this->belongsTo(Pembelian::class, 'id_pembelian');
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang');
    }

    public function warna() {
        return $this->belongsTo(Warna::class, 'id_warna');
    }
}
