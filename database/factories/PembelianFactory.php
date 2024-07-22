<?php

namespace Database\Factories;

use App\Models\Pembelian;
use App\Models\Vendor;
use App\Models\Status;
use App\Models\Pengirim;
use Illuminate\Database\Eloquent\Factories\Factory;

class PembelianFactory extends Factory
{
    protected $model = Pembelian::class;

    public function definition()
    {
        return [
            'id_vendor' => Vendor::factory(),
            'tgl_pembelian' => $this->faker->date(),
            'id_status' => Status::factory(),
            'id_pengirim' => Pengirim::factory(),
            'tgl_pengiriman' => $this->faker->optional()->date(),
        ];
    }
}
