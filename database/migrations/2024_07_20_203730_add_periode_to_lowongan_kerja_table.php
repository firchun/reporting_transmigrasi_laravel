<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lowongan_kerja', function (Blueprint $table) {
            $table->date('tanggal_buka')->after('brosur');
            $table->date('tanggal_tutup')->after('tanggal_buka');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lowongan_kerja', function (Blueprint $table) {
            //
        });
    }
};
