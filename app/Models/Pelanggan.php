<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasFactory;

    protected $table = 'pelanggan'; // Nama tabel yang ada di database

    protected $fillable = [
        'nama',
        'tgl_lahir',
        'no_hp',
        'email',
        'alamat',
        'wilayah',
        'provinsi',
        'user_id'
    ];

    public function penjualans()
    {
        return $this->hasMany(Penjualan::class, 'id_pelanggan');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
