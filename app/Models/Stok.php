<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Stok extends Model
{
    use HasFactory;

    protected $table = 'stok';

    protected $fillable = [
        'id_pembelian',
        'id_pembelian_item',
        'id_barang',
        'id_warna',
        'no_rangka',
        'no_mesin',
        'harga',
        'status',
        'tgl_penerimaan',
    ];

    protected $dates = [
        'tgl_penerimaan',
    ];

    // Accessor for tgl_penerimaan
    public function getTglPenerimaanAttribute($value)
    {
        return $value ? Carbon::parse($value)->format('Y-m-d') : null;
    }

    public function pembelian() {
        return $this->belongsTo(Pembelian::class, 'id_pembelian');
    }

    public function penjualan() {
        return $this->belongsTo(Penjualan::class, 'id_penjualan');
    }

    public function PembelianItem() {
        return $this->hasMany(PembelianItem::class, 'id_stok');
    }
    
    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang');
    }

    public function warna()
    {
        return $this->belongsTo(Warna::class, 'id_warna');
    }

    public function stokTerjual()
    {
        return $this->hasMany(StokTerjual::class, 'id_stok');
    }
}
