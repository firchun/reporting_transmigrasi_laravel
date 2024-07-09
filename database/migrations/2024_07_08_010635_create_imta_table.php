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
        Schema::create('imta', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_tenaga_asing');
            $table->string('no_imta');
            $table->timestamps();

            $table->foreign('id_tenaga_asing')->references('id')->on('tenaga_asing');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('imta');
    }
};
