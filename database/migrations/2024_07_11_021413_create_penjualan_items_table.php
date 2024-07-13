<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenjualanItemsTable extends Migration
{
    public function up()
    {
        Schema::create('penjualan_items', function (Blueprint $table) {
            $table->foreignId('id_penjualan')->constrained('penjualan')->cascadeOnUpdate();
            $table->foreignId('id_barang')->constrained('barang')->cascadeOnUpdate();
            $table->integer('qty');
            $table->bigInteger('harga');
            $table->integer('ppn')->default(11);
            $table->timestamps();
            $table->primary(['id_penjualan', 'id_barang']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('penjualan_items');
    }
}
