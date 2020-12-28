<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMensualidadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mensualidades', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_inmueble');
            $table->integer('mes');
            $table->integer('anio');
            $table->float('monto');

            $table->foreign('id_inmueble')->references('id')->on('inmuebles')->onDelete('cascade');
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
        Schema::dropIfExists('mensualidades');
    }
}
