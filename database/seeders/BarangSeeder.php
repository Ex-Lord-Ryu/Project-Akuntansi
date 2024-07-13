<?php

namespace Database\Seeders;

use App\Models\Barang;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BarangSeeder extends Seeder
{
    public function run()
    {
        Barang::factory()->count(0)->create();
        
        $barangs = [
            ['nama' => 'Honda Vario 125 CBS', 'stok' => 0],
            ['nama' => 'Honda Vario 125 CBS ISS', 'stok' => 0],
            ['nama' => 'Honda Vario 125 CBS ISS SP', 'stok' => 0],
            ['nama' => 'Honda Scoopy Sporty', 'stok' => 0],
            ['nama' => 'Honda Scoopy Fashion', 'stok' => 0],
            ['nama' => 'Honda Scoopy Stylish', 'stok' => 0],
            ['nama' => 'Honda Scoopy Prestige', 'stok' => 0],
            ['nama' => 'Honda Beat CBS', 'stok' => 0],
            ['nama' => 'Honda Beat Deluxe', 'stok' => 0],
            ['nama' => 'Honda Beat Smart Key', 'stok' => 0],
            ['nama' => 'Honda PCX160 CBS', 'stok' => 0],
            ['nama' => 'Honda PCX160 ABS', 'stok' => 0],
            ['nama' => 'Honda Vario 160 CBS', 'stok' => 0],
            ['nama' => 'Honda Vario 160 CBS Grande', 'stok' => 0],
            ['nama' => 'Honda Vario 160 ABS', 'stok' => 0],
            ['nama' => 'Honda Beat Street CBS', 'stok' => 0],
            ['nama' => 'Honda Stylo 160 CBS', 'stok' => 0],
            ['nama' => 'Honda Stylo 160 ABS', 'stok' => 0],
            ['nama' => 'Honda CRF150L Standard', 'stok' => 0],
            ['nama' => 'Honda ADV 160 CBS', 'stok' => 0],
            ['nama' => 'Honda ADV 160 ABS', 'stok' => 0],
            ['nama' => 'Honda Genio CBS', 'stok' => 0],
            ['nama' => 'Honda Genio CBS ISS', 'stok' => 0],
            ['nama' => 'Honda Supra GTR 150 Sporty', 'stok' => 0],
            ['nama' => 'Honda Supra GTR 150 Exclusive', 'stok' => 0],
            ['nama' => 'Honda Sonic 150R Racing Red', 'stok' => 0],
            ['nama' => 'Honda Supra X 125 FI Spoke FI', 'stok' => 0],
            ['nama' => 'Honda Supra X 125 FI CW Luxury', 'stok' => 0],
            ['nama' => 'Honda CBR250RR Standard', 'stok' => 0],
            ['nama' => 'Honda CBR250RR SP', 'stok' => 0],
            ['nama' => 'Honda CBR150R Standard', 'stok' => 0],
            ['nama' => 'Honda CBR150R Racing Red Standard', 'stok' => 0],
            ['nama' => 'Honda CBR150R MotoGP Edition ABS', 'stok' => 0],
            ['nama' => 'Honda CBR150R Racing Red ABS', 'stok' => 0],
            ['nama' => 'Honda CBR150R ABS', 'stok' => 0],
            ['nama' => 'Honda Revo Fit', 'stok' => 0],
            ['nama' => 'Honda Revo X', 'stok' => 0],
            ['nama' => 'Honda CB150 Verza Spoke', 'stok' => 0],
            ['nama' => 'Honda CB150 Verza CW', 'stok' => 0],
            ['nama' => 'Honda CB150R Streetfire Standard', 'stok' => 0],
            ['nama' => 'Honda CB150R Streetfire Special Edition', 'stok' => 0],
            ['nama' => 'Honda CB150X Standard', 'stok' => 0],
            ['nama' => 'Honda Forza 250 Standard', 'stok' => 0],
            ['nama' => 'Honda CRF250Rally Standard', 'stok' => 0],
            ['nama' => 'Honda CB650R Standard', 'stok' => 0],
            ['nama' => 'Honda CRF250L Standard', 'stok' => 0],
            ['nama' => 'Honda EM1 E Electric', 'stok' => 0],
            ['nama' => 'Honda EM1 E Plus', 'stok' => 0],
            ['nama' => 'Honda Rebel Standard', 'stok' => 0],
            ['nama' => 'Honda CB500X Standard', 'stok' => 0],
            ['nama' => 'Honda Monkey Standard', 'stok' => 0],
            ['nama' => 'Honda Super Cub 125 Standard', 'stok' => 0],
            ['nama' => 'Honda CT125 Standard', 'stok' => 0],
            ['nama' => 'Honda CBR1000RR-R STD', 'stok' => 0],
            ['nama' => 'Honda ST125 Dax Standard', 'stok' => 0],
            ['nama' => 'Honda Goldwing Standard', 'stok' => 0],
            ['nama' => 'Honda CRF1100L Africa Twin Manual', 'stok' => 0],
            ['nama' => 'Honda CRF1100L Africa Twin DCT', 'stok' => 0],
            ['nama' => 'Honda XL750 Transalp Standard', 'stok' => 0],
            ['nama' => 'Honda Rebel 1100 Standard', 'stok' => 0],
        ];

        DB::table('barang')->insert($barangs);
    }
}
