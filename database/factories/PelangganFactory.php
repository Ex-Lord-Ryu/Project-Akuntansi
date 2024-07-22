<?php

namespace Database\Factories;

use App\Models\Pelanggan;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PelangganFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Pelanggan::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nama' => $this->faker->name,
            'tgl_lahir' => $this->faker->date(),
            'no_hp' => $this->faker->phoneNumber,
            'email' => $this->faker->unique()->safeEmail,
            'alamat' => $this->faker->address,
            'wilayah' => $this->faker->city,
            'provinsi' => $this->faker->state,
        ];
    }
}
