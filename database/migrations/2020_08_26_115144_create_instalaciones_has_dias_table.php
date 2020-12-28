<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInstalacionesHasDiasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instalaciones_has_dias', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_instalacion');
            $table->unsignedBigInteger('id_dia');

            $table->foreign('id_instalacion')->references('id')->on('instalaciones')->onDelete('cascade');

            $table->foreign('id_dia')->references('id')->on('dias')->onDelete('cascade');

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
        Schema::dropIfExists('instalaciones_has_dias');
    }
}
