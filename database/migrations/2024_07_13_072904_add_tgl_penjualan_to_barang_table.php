<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTglPenjualanToBarangTable extends Migration
{
    public function up()
    {
        Schema::table('barang', function (Blueprint $table) {
            $table->date('tgl_penjualan')->nullable()->after('tgl_pengiriman');
        });
    }

    public function down()
    {
        Schema::table('barang', function (Blueprint $table) {
            $table->dropColumn('tgl_penjualan');
        });
    }
}

