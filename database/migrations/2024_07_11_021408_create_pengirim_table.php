<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengirimTable extends Migration
{
    public function up()
    {
        Schema::create('pengirims', function (Blueprint $table) {
            $table->id();
            $table->string('jenis');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pengirims');
    }
}



