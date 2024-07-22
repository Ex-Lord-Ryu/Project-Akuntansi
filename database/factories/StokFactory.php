<?php

namespace Database\Factories;

use App\Models\Stok;
use App\Models\Barang;
use App\Models\Warna;
use App\Models\Pembelian;
use App\Models\PembelianItem;
use Illuminate\Database\Eloquent\Factories\Factory;

class StokFactory extends Factory
{
    protected $model = Stok::class;

    public function definition()
    {
        $barang = Barang::inRandomOrder()->first();
        $warna = Warna::inRandomOrder()->first();

        // Create a dummy Pembelian and PembelianItem for initial stock
        $pembelian = Pembelian::factory()->create();
        $pembelianItem = PembelianItem::factory()->create([
            'id_pembelian' => $pembelian->id,
            'id_barang' => $barang->id,
            'id_warna' => $warna->id,
        ]);

        return [
            'id_pembelian' => $pembelian->id,
            'id_pembelian_item' => $pembelianItem->id,
            'id_barang' => $barang->id,
            'id_warna' => $warna->id,
            'harga' => $this->faker->numberBetween(100000, 1000000),
            'no_rangka' => strtoupper($this->faker->bothify('??###??##')),
            'no_mesin' => strtoupper($this->faker->bothify('??###??##')),
            'tgl_penerimaan' => $this->faker->dateTimeBetween('-3 years', 'now')->format('Y-m-d'),
            'status' => 'available', // default status
        ];
    }
}
