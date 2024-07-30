<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMetodePembayaranToPenjualanItemTable extends Migration
{
    public function up()
    {
        Schema::table('penjualan_item', function (Blueprint $table) {
            $table->string('metode_pembayaran')->after('harga');
        });
    }

    public function down()
    {
        Schema::table('penjualan_item', function (Blueprint $table) {
            $table->dropColumn('metode_pembayaran');
        });
    }
}
