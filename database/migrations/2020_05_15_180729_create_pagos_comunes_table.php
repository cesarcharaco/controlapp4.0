<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagosComunesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagos_comunes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->enum('tipo',['Inmueble','Estacionamiento']);
            $table->integer('mes');
            $table->integer('anio');
            $table->float('monto');
            $table->unsignedBigInteger('id_admin');

            $table->foreign('id_admin')->references('id')->on('users_admin')->onDelete('cascade');
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
        Schema::dropIfExists('pagos_comunes');
    }
}
