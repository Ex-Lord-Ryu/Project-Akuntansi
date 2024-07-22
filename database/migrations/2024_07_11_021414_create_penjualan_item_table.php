<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenjualanItemTable extends Migration
{
    public function up()
    {
        Schema::create('penjualan_item', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_penjualan')->constrained('penjualan')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('id_barang')->constrained('barang')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('id_stok')->constrained('stok')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('id_warna', 4)->nullable()->constrained('warna')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('no_rangka', 50)->nullable();
            $table->string('no_mesin', 50)->nullable();
            $table->bigInteger('harga');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('penjualan_item');
    }
}
