<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Warna;

class WarnaSeeder extends Seeder
{
    public function run()
    {
        $warna = [
            ['id' => 'BLK', 'warna' => 'Black'],
            ['id' => 'WHT', 'warna' => 'White'],
            ['id' => 'RED', 'warna' => 'Red'],
            ['id' => 'GRY', 'warna' => 'Gray/Metallic'],
            ['id' => 'BLU', 'warna' => 'Blue'],
            ['id' => 'GRN', 'warna' => 'Green'],
            ['id' => 'ORN', 'warna' => 'Orange'],
            ['id' => 'BRN', 'warna' => 'Brown'],
            ['id' => 'YLW', 'warna' => 'Yellow'],
            ['id' => 'PUR', 'warna' => 'Purple'],
            ['id' => 'SLV', 'warna' => 'Silver'],
            ['id' => 'PRL', 'warna' => 'Pearl Finishes'],
        ];

        foreach ($warna as $w) {
            Warna::create($w);
        }
    }
}
