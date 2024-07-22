<?php

namespace Database\Factories;

use App\Models\Warna;
use Illuminate\Database\Eloquent\Factories\Factory;

class WarnaFactory extends Factory
{
    protected $model = Warna::class;

    public function definition()
    {
        return [
            'id' => $this->faker->unique()->lexify('???'), // Ensure unique IDs for each color
            'warna' => $this->faker->randomElement([
                'Black', 'White', 'Red', 'Gray/Metallic', 'Blue', 'Green', 'Orange', 'Brown', 'Yellow', 'Purple', 'Silver', 'Pearl Finishes'
            ]),
        ];
    }
}
