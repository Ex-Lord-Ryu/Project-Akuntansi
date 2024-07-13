<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Barang;

class BarangFactory extends Factory
{
    protected $model = Barang::class;

    public function definition()
    {
        return [
            'nama' => $this->faker->randomElement([
                'Honda Vario 125 CBS',
                'Honda Vario 125 CBS ISS',
                'Honda Vario 125 CBS ISS SP',
                'Honda Scoopy Sporty',
                'Honda Scoopy Fashion',
                'Honda Scoopy Stylish',
                'Honda Scoopy Prestige',
                'Honda Beat CBS',
                'Honda Beat Deluxe',
                'Honda Beat Smart Key',
                'Honda PCX160 CBS',
                'Honda PCX160 ABS',
                'Honda Vario 160 CBS',
                'Honda Vario 160 CBS Grande',
                'Honda Vario 160 ABS',
                'Honda EM1 E Electric',
                'Honda EM1 E Plus',
                'Honda Rebel Standard',
                'Honda CB500X Standard',
                'Honda Monkey Standard',
                'Honda Super Cub 125 Standard',
                'Honda CT125 Standard',
                'Honda CBR1000RR-R STD',
                'Honda ST125 Dax Standard',
                'Honda Goldwing Standard',
                'Honda CRF1100L Africa Twin Manual',
                'Honda CRF1100L Africa Twin DCT',
                'Honda XL750 Transalp Standard',
                'Honda Rebel 1100 Standard'
            ]),
            'stok' => $this->faker->numberBetween(0, 100),
            'harga' => $this->faker->randomElement([
               0
            ]),
        ];
    }
}
