<?php

namespace App\Models;

use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    public static function boot()
    {
        parent::boot();

        static::updating(function ($item) {
            Log::info('Updating item in database:', $item->toArray());
        });

        static::creating(function ($item) {
            Log::info('Creating new item in database:', $item->toArray());
        });

        static::updated(function ($item) {
            Log::info('Item updated in database:', $item->toArray());
        });

        static::saved(function ($item) {
            Log::info('Item saved in database:', $item->toArray());
        });
    }

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
