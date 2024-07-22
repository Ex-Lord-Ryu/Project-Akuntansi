<?php

namespace Database\Factories;

use App\Models\Pengirim;
use Illuminate\Database\Eloquent\Factories\Factory;

class PengirimFactory extends Factory
{
    protected $model = Pengirim::class;

    public function definition()
    {
        return [
            'jenis' => $this->faker->company,
        ];
    }
}
