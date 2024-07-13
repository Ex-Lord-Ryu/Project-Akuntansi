<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembelian extends Model
{
    use HasFactory;

    protected $table = 'pembelian';

    protected $fillable = [
        'id_vendor',
        'tgl_pembelian',
        'id_status',
        'id_pengirim',
        'tgl_pengiriman',
    ];

    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'id_vendor');
    }

    public function pengirim()
    {
        return $this->belongsTo(Pengirim::class, 'id_pengirim');
    }

    public function status()
    {
        return $this->belongsTo(Status::class, 'id_status');
    }

    public function items()
    {
        return $this->hasMany(PembelianItem::class, 'id_pembelian');
    }
}
