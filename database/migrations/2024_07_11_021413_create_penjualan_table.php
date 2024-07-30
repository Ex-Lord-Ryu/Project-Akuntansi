<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenjualanTable extends Migration
{
    public function up()
    {
        Schema::create('penjualan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_pelanggan')->constrained('pelanggan')->cascadeOnUpdate();
            $table->date('tgl_penjualan');
            $table->foreignId('id_status')->constrained('statuses')->cascadeOnUpdate();
            $table->foreignId('id_pengirim')->nullable()->constrained('pengirims')->cascadeOnUpdate();
            $table->date('tgl_penerimaan');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('penjualan');
    }
}
