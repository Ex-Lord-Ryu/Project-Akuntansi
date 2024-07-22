<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Penjualan;
use App\Models\PenjualanItem;
use App\Models\Stok;

class PenjualanSeeder extends Seeder
{
    public function run()
    {
        Penjualan::factory()
            ->count(rand(10, 20))
            ->has(PenjualanItem::factory()->count(rand(1, 5)), 'items')
            ->create()
            ->each(function ($penjualan) {
                $penjualan->items->each(function ($item) {
                    Stok::create([
                        'id_barang' => $item->id_barang,
                        'id_warna' => $item->id_warna,
                        'jumlah' => -1, // Assuming each penjualan item reduces the stok by 1
                        'harga' => $item->harga,
                        'no_rangka' => $item->no_rangka,
                        'no_mesin' => $item->no_mesin,
                    ]);
                });
            });
    }
}
