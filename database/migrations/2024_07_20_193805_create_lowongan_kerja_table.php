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
        Schema::create('lowongan_kerja', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_perusahaan');
            $table->string('posisi');
            $table->text('deskripsi_pekerjaan');
            $table->string('kualifikasi');
            $table->text('persyaratan');
            $table->text('pengiriman_bekas');
            $table->string('brosur')->nullable();
            $table->timestamps();

            $table->foreign('id_perusahaan')->references('id')->on('perusahaan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lowongan_kerja');
    }
};
