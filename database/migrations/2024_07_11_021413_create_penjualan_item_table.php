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
            $table->foreignId('penjualan_id')->constrained('penjualan')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('barang_id')->constrained('barang')->cascadeOnUpdate()->cascadeOnDelete();
            $table->integer('qty');
            $table->bigInteger('harga');
            $table->integer('ppn')->default(11);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('penjualan_item');
    }
}


