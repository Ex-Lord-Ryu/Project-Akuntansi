<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePembelianItemTable extends Migration
{
    public function up()
    {
        Schema::create('pembelian_item', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_pembelian')->constrained('pembelian')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('id_barang')->constrained('barang')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('id_warna', 4)->nullable()->constrained('warna')->cascadeOnUpdate()->cascadeOnDelete();
            $table->bigInteger('harga')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pembelian_item');
    }
}
