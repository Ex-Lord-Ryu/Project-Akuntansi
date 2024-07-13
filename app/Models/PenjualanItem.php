<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenjualanItem extends Model
{
    use HasFactory;

    protected $table = 'penjualan_item'; // Ensure the correct table name

    protected $fillable = [
        'penjualan_id',
        'barang_id',
        'qty',
        'harga',
        'ppn',
    ];

    public function penjualan()
    {
        return $this->belongsTo(Penjualan::class, 'penjualan_id');
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'barang_id');
    }
}
