<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePembelianTable extends Migration
{
    public function up()
    {
        Schema::create('pembelian', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_vendor')->constrained('vendors')->cascadeOnUpdate();
            $table->dateTime('tgl_pembelian');
            $table->foreignId('id_status')->constrained('statuses')->cascadeOnUpdate(); // Periksa nama tabel yang dirujuk
            $table->foreignId('id_pengirim')->nullable()->constrained('pengirims')->cascadeOnUpdate();
            $table->dateTime('tgl_pengiriman')->nullable();
            $table->dateTime('tgl_penerimaan')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pembelian');
    }
}

