<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory(1)->create();

        \App\Models\User::factory()->create([
            'name' => 'Rangga Yuda Pratama',
            'email' => 'Ranggayuda2003@gmail.com',
            'password' => '123456789'
        ]);

        $this->call([
            VendorSeeder::class,
            PengirimSeeder::class,
            StatusSeeder::class,
            BarangSeeder::class,
        ]);
    }
}
