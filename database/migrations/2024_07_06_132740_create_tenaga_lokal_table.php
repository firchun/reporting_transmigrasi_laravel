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
        Schema::create('tenaga_lokal', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_perusahaan');
            $table->foreignId('id_pendidikan');
            $table->string('nama');
            $table->string('mulai_kerja');
            $table->string('no_kartu_kuning');
            $table->enum('jenis_kelamin', ['P', 'L']);
            $table->enum('tenaga_kerja', ['OAP', 'NON-OAP'])->default('OAP');
            $table->enum('status_karyawan', ['Karyawan Tetap', 'Karyawan Kontrak', 'Tenaga Ahli'])->default('Karyawan Tetap');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->string('jabatan');
            $table->enum('LPTKS', ['Ada', 'Tidak'])->default('Ada');
            $table->timestamps();

            $table->foreign('id_perusahaan')->references('id')->on('perusahaan');
            $table->foreign('id_pendidikan')->references('id')->on('pendidikan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tenaga_lokal');
    }
};
