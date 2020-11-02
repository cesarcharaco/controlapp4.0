<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContabilidadTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contabilidad', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_mensualidad')->nullable();
            $table->unsignedBigInteger('id_mes');
            $table->string('descripcion');
            $table->float('ingreso');
            $table->float('egreso');
            $table->float('saldo');

            $table->foreign('id_mensualidad')->references('id')->on('mensualidades');
            $table->foreign('id_mes')->references('id')->on('meses');
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
        Schema::dropIfExists('contabilidad');
    }
}
