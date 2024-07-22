<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStokTable extends Migration
{
    public function up()
    {
        Schema::create('stok', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_pembelian')->constrained('pembelian')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('id_pembelian_item')->constrained('pembelian_item')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('id_barang')->constrained('barang')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('id_warna', 4)->nullable();
            $table->string('no_rangka', 50)->nullable();
            $table->string('no_mesin', 50)->nullable();
            $table->bigInteger('harga')->nullable();
            $table->date('tgl_penerimaan')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('stok');
    }
}

