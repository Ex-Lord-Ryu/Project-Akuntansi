<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    use HasFactory;

    protected $table = 'penjualan'; // Name of the table in the database

    protected $fillable = [
        'user_id',
        'id_pelanggan',
        'tgl_penjualan',
        'id_status',
        'id_pengirim',
        'tgl_penerimaan',
        
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'id_pelanggan');
    }

    public function pengirim()
    {
        return $this->belongsTo(Pengirim::class, 'id_pengirim');
    }

    public function status()
    {
        return $this->belongsTo(Status::class, 'id_status');
    }

    public function penjualanItems()
    {
        return $this->hasMany(PenjualanItem::class, 'id_penjualan');
    }
    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang');
    }

}
