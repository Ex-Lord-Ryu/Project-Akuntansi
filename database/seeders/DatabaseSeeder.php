<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Stok;
use App\Models\Status;
use App\Models\Pengirim;
use App\Models\Pelanggan;
use App\Models\Pembelian;
use App\Models\Penjualan;
use App\Models\PembelianItem;
use App\Models\PenjualanItem;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory(0)->create();
        Pelanggan::factory()->count(1)->create();

        \App\Models\User::factory()->create([
            'name' => 'Admin',
            'email' => 'Admin@gmail.com',
            'usertype' => 'admin', 
            'password' => '123456789'
        ]);

        $this->call([
            VendorSeeder::class,
            PengirimSeeder::class,
            StatusSeeder::class,
            BarangSeeder::class,
            WarnaSeeder::class,
            // PembelianSeeder::class,
            // PenjualanSeeder::class,
        ]);

        // // Seed statuses
        // Status::factory()->create(['nama_status' => 'On Process']);
        // Status::factory()->create(['nama_status' => 'Shipped']);
        // Status::factory()->create(['nama_status' => 'canceled']);
        // Status::factory()->create(['nama_status' => 'Delivered']);

        // Seed pengirims
    //     Pengirim::factory(10)->create();

    //    // Ensure colors are seeded
    //    $this->call(WarnaSeeder::class);

    //    // Create initial stock
    //    Stok::factory(50)->create();

    //    // Create purchases and update stock
    //    Pembelian::factory(15)->create()->each(function ($pembelian) {
    //        $items = PembelianItem::factory(3)->make();
    //        foreach ($items as $item) {
    //            $item->id_pembelian = $pembelian->id;
    //            $item->save();

    //            $stok = Stok::where('id_barang', $item->id_barang)
    //                ->where('id_warna', $item->id_warna)
    //                ->first();

    //            if ($stok) {
    //                $stok->update([
    //                    'available' => $stok->available + 1
    //                ]);
    //            } else {
    //                Stok::create([
    //                    'id_pembelian' => $pembelian->id,
    //                    'id_pembelian_item' => $item->id,
    //                    'id_barang' => $item->id_barang,
    //                    'id_warna' => $item->id_warna,
    //                    'harga' => $item->harga,
    //                    'tgl_penerimaan' => now()->toDateString(),
    //                    'status' => 'available',
    //                ]);
    //            }
    //        }
    //    });

    //    // Create sales and update stock
    //    Penjualan::factory(15)->create()->each(function ($penjualan) {
    //        $items = PenjualanItem::factory(3)->make();
    //        foreach ($items as $item) {
    //            $stok = Stok::where('id_barang', $item->id_barang)
    //                ->where('id_warna', $item->id_warna)
    //                ->first();

    //            if ($stok && $stok->available > 0) {
    //                $item->id_penjualan = $penjualan->id;
    //                $item->save();

    //                $stok->update([
    //                    'available' => $stok->available - 1,
    //                    'sold' => $stok->sold + 1,
    //                ]);

    //                $penjualan->items()->save($item);
    //            }
    //        }
    //    });
    }
}
