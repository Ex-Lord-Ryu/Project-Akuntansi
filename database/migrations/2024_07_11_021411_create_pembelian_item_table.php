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
            $table->foreignId('id_pembelian')->constrained('pembelian')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('id_barang')->constrained('barang')->cascadeOnDelete()->cascadeOnUpdate();
            $table->integer('qty');
            $table->bigInteger('harga');
            $table->integer('ppn')->default(11);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pembelian_item');
    }
}

