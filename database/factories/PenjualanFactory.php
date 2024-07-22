<?php

namespace Database\Factories;

use App\Models\Penjualan;
use App\Models\Pelanggan;
use App\Models\Status;
use Illuminate\Database\Eloquent\Factories\Factory;

class PenjualanFactory extends Factory
{
    protected $model = Penjualan::class;

    public function definition()
    {
        return [
            'id_pelanggan' => Pelanggan::factory(),
            'tgl_penjualan' => $this->faker->date(),
            'id_status' => Status::factory(),
        ];
    }
}
