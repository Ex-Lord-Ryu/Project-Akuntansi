<?php

namespace Database\Factories;

use App\Models\PenjualanItem;
use App\Models\Barang;
use App\Models\Warna;
use Illuminate\Database\Eloquent\Factories\Factory;

class PenjualanItemFactory extends Factory
{
    protected $model = PenjualanItem::class;

    public function definition()
    {
        return [
            'id_barang' => Barang::factory(),
            'id_warna' => Warna::inRandomOrder()->first()->id,
            'harga' => $this->faker->numberBetween(500000, 10000000),
        ];
    }
}
