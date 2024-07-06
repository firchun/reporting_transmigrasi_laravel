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
        Schema::create('tenaga_asing', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_perusahaan');
            $table->string('nama');
            $table->enum('jenis_kelamin', ['P', 'L']);
            $table->string('kebangsaan');
            $table->string('jabatan');
            $table->string('no_passport');
            $table->string('no_kitas');
            $table->string('no_imta');
            $table->string('sponsor')->nullable();
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
        Schema::dropIfExists('tenaga_asing');
    }
};
