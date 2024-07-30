<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePelangganTable extends Migration
{
    public function up()
    {
        Schema::create('pelanggan', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 50);
            $table->date('tgl_lahir');
            $table->string('no_hp', 50)->nullable();
            $table->string('email', 50)->nullable();
            $table->string('alamat', 255);
            $table->string('wilayah', 50);
            $table->string('provinsi', 50);
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pelanggan');
    }
}
