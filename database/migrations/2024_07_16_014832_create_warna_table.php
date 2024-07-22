<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWarnaTable extends Migration
{
    public function up()
    {
        Schema::create('warna', function (Blueprint $table) {
            $table->string('id', 4)->primary();
            $table->string('warna');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('warna');
    }
}

