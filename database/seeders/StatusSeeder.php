<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusSeeder extends Seeder
{
    public function run()
    {
        DB::table('statuses')->insert([
            ['nama_status' => 'Dalam Proses'],
            ['nama_status' => 'Payment'],
            ['nama_status' => 'Delivered'],
            ['nama_status' => 'Shipped']
        ]);
    }
}

