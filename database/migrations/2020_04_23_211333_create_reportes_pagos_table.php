<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReportesPagosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reportes_pagos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('referencia');
            $table->text('reporte');
            $table->unsignedBigInteger('id_residente');
            $table->enum('tipo',['Cancelado','Pendiente','No Aplica'])->default('Cancelado');

            $table->foreign('id_residente')->references('id')->on('residentes')->ondelete('cascade');
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
        Schema::dropIfExists('reportes_pagos');
    }
}
