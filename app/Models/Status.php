<?php

// app/Models/Status.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;

    protected $table = 'statuses'; // Pastikan nama tabel benar

    protected $fillable = [
        'nama_status',
    ];

    public function pembelians()
    {
        return $this->hasMany(Pembelian::class, 'id_status');
    }
}




