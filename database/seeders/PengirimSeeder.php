<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PengirimSeeder extends Seeder
{
    public function run()
    {
        DB::table('pengirims')->insert([
            ['jenis' => 'Truck'],
            ['jenis' => 'Pick Up']
        ]);
    }
}
