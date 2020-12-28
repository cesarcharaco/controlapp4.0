<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlquilerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alquiler', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_residente');
            $table->unsignedBigInteger('id_instalacion');
            $table->enum('tipo_alquiler',['Permanente','Temporal','Permanente/Temporal']);
            $table->date('fecha')->nullable();
            $table->time('hora')->nullable();
            $table->string('num_horas');
            $table->enum('status',['Activo','Inactivo']);

            $table->foreign('id_residente')->references('id')->on('residentes')->onDelete('cascade');
            $table->foreign('id_instalacion')->references('id')->on('instalaciones')->onDelete('cascade');
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
        Schema::dropIfExists('alquiler');
    }
}
