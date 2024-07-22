<?php

namespace Database\Factories;

use App\Models\Status;
use Illuminate\Database\Eloquent\Factories\Factory;

class StatusFactory extends Factory
{
    protected $model = Status::class;

    public function definition()
    {
        return [
            'nama_status' => $this->faker->randomElement(['On Process', 'Payment', 'Cancel', 'Delivered']),
        ];
    }
}
