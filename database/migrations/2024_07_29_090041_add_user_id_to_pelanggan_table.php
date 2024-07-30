<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('pelanggan', function (Blueprint $table) {
            if (!Schema::hasColumn('pelanggan', 'user_id')) {
                $table->foreignId('user_id')->nullable()->constrained()->cascadeOnDelete()->after('provinsi');
            }
        });
    }

    public function down()
    {
        Schema::table('pelanggan', function (Blueprint $table) {
            if (Schema::hasColumn('pelanggan', 'user_id')) {
                $table->dropForeign(['user_id']);
                $table->dropColumn('user_id');
            }
        });
    }
};
