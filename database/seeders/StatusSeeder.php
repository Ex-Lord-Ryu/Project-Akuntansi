<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusSeeder extends Seeder
{
    public function run()
    {
        DB::table('statuses')->insert([
            ['nama_status' => 'Pilih Status'],
            ['nama_status' => 'On Process'],
            ['nama_status' => 'Shipped'],
            ['nama_status' => 'Cancel'],
            ['nama_status' => 'Delivered']
        ]);
    }
}

