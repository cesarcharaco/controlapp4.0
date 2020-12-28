<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMensEstacTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mens_estac', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_estacionamiento');
            $table->integer('mes');
            $table->integer('anio');
            $table->float('monto');

            $table->foreign('id_estacionamiento')->references('id')->on('estacionamientos')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mens_estac');
    }
}
