<?php

namespace App\Models;

use App\Models\Warna;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'barang';

    protected $fillable = [
        'nama',
        'image',
    ];

    public function pembelianItems()
    {
        return $this->hasMany(PembelianItem::class, 'id_barang');
    }

    public function penjualanItems()
    {
        return $this->hasMany(PenjualanItem::class, 'id_barang');
    }

    public function warna()
    {
        return $this->hasMany(Warna::class, 'id_barang');
    }
    
    public function stok()
    {
        return $this->hasMany(Stok::class, 'id_barang');
    }
}

//     public function getTglPengirimanAttribute()
//     {
//         $latestPembelianItem = $this->pembelianItems()->latest()->first();
//         return $latestPembelianItem ? $latestPembelianItem->pembelian->tgl_pengiriman : null;
//     }

//     public function getTglPenjualanAttribute()
//     {
//         $latestPenjualanItem = $this->penjualanItems()->latest()->first();
//         return $latestPenjualanItem ? $latestPenjualanItem->penjualan->tgl_penjualan : null;
//     }
// }
