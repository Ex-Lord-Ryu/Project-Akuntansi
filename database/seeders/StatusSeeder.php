<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Status;

class StatusSeeder extends Seeder
{
    public function run()
    {
        $statuses = ['On Process', 'Payment', 'Cancel', 'Delivered'];

        foreach ($statuses as $status) {
            Status::create(['nama_status' => $status]);
        }
    }
}
