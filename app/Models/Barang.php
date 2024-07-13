<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'barang';

    protected $fillable = [
        'nama',
        'stok',
        'harga',
    ];

    public function pembelianItems()
    {
        return $this->hasMany(PembelianItem::class, 'id_barang');
    }

    public function penjualanItems()
    {
        return $this->hasMany(PenjualanItem::class, 'id_barang');
    }

    public function getTglPengirimanAttribute()
    {
        $latestPembelianItem = $this->pembelianItems()->latest()->first();
        return $latestPembelianItem ? $latestPembelianItem->pembelian->tgl_pengiriman : null;
    }

    public function getTglPenjualanAttribute()
    {
        $latestPenjualanItem = $this->penjualanItems()->latest()->first();
        return $latestPenjualanItem ? $latestPenjualanItem->penjualan->tgl_penjualan : null;
    }
}
