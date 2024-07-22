<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pembelian;
use App\Models\PembelianItem;
use App\Models\Stok;

class PembelianSeeder extends Seeder
{
    public function run()
    {
        Pembelian::factory()
            ->count(rand(10, 20))
            ->has(PembelianItem::factory()->count(rand(1, 5)), 'items')
            ->create()
            ->each(function ($pembelian) {
                $pembelian->items->each(function ($item) {
                    Stok::factory()->create([
                        'id_pembelian_item' => $item->id,
                        'id_barang' => $item->id_barang,
                        'id_warna' => $item->id_warna,
                        'harga' => $item->harga,
                    ]);
                });
            });
    }
}
