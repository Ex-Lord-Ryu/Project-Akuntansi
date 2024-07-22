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
            ['nama' => 'Honda Vario 125 CBS'],
            ['nama' => 'Honda Vario 125 CBS ISS'],
            ['nama' => 'Honda Vario 125 CBS ISS SP'],
            ['nama' => 'Honda Scoopy Sporty'],
            ['nama' => 'Honda Scoopy Fashion'],
            ['nama' => 'Honda Scoopy Stylish'],
            ['nama' => 'Honda Scoopy Prestige'],
            ['nama' => 'Honda Beat CBS'],
            ['nama' => 'Honda Beat Deluxe'],
            ['nama' => 'Honda Beat Smart Key'],
            ['nama' => 'Honda PCX160 CBS'],
            ['nama' => 'Honda PCX160 ABS'],
            ['nama' => 'Honda Vario 160 CBS'],
            ['nama' => 'Honda Vario 160 CBS Grande'],
            ['nama' => 'Honda Vario 160 ABS'],
            ['nama' => 'Honda Beat Street CBS'],
            ['nama' => 'Honda Stylo 160 CBS'],
            ['nama' => 'Honda Stylo 160 ABS'],
            ['nama' => 'Honda CRF150L Standard'],
            ['nama' => 'Honda ADV 160 CBS'],
            ['nama' => 'Honda ADV 160 ABS'],
            ['nama' => 'Honda Genio CBS'],
            ['nama' => 'Honda Genio CBS ISS'],
            ['nama' => 'Honda Supra GTR 150 Sporty'],
            ['nama' => 'Honda Supra GTR 150 Exclusive'],
            ['nama' => 'Honda Sonic 150R Racing Red'],
            ['nama' => 'Honda Supra X 125 FI Spoke FI'],
            ['nama' => 'Honda Supra X 125 FI CW Luxury'],
            ['nama' => 'Honda CBR250RR Standard'],
            ['nama' => 'Honda CBR250RR SP'],
            ['nama' => 'Honda CBR150R Standard'],
            ['nama' => 'Honda CBR150R Racing Red Standard'],
            ['nama' => 'Honda CBR150R MotoGP Edition ABS'],
            ['nama' => 'Honda CBR150R Racing Red ABS'],
            ['nama' => 'Honda CBR150R ABS'],
            ['nama' => 'Honda Revo Fit'],
            ['nama' => 'Honda Revo X'],
            ['nama' => 'Honda CB150 Verza Spoke'],
            ['nama' => 'Honda CB150 Verza CW'],
            ['nama' => 'Honda CB150R Streetfire Standard'],
            ['nama' => 'Honda CB150R Streetfire Special Edition'],
            ['nama' => 'Honda CB150X Standard'],
            ['nama' => 'Honda Forza 250 Standard'],
            ['nama' => 'Honda CRF250Rally Standard'],
            ['nama' => 'Honda CB650R Standard'],
            ['nama' => 'Honda CRF250L Standard'],
            ['nama' => 'Honda EM1 E Electric'],
            ['nama' => 'Honda EM1 E Plus'],
            ['nama' => 'Honda Rebel Standard'],
            ['nama' => 'Honda CB500X Standard'],
            ['nama' => 'Honda Monkey Standard'],
            ['nama' => 'Honda Super Cub 125 Standard'],
            ['nama' => 'Honda CT125 Standard'],
            ['nama' => 'Honda CBR1000RR-R STD'],
            ['nama' => 'Honda ST125 Dax Standard'],
            ['nama' => 'Honda Goldwing Standard'],
            ['nama' => 'Honda CRF1100L Africa Twin Manual'],
            ['nama' => 'Honda CRF1100L Africa Twin DCT'],
            ['nama' => 'Honda XL750 Transalp Standard'],
            ['nama' => 'Honda Rebel 1100 Standard'],
        ];

        foreach ($barangs as $b) {
            Barang::create($b);
        }
    }
}
