<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResidentesHasInmueblesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('residentes_has_inmuebles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_residente');
            $table->unsignedBigInteger('id_inmueble');
            $table->enum('status',['En Uso','Retirado'])->default('En Uso');

            $table->foreign('id_residente')->references('id')->on('residentes')->onDelete('cascade');
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
        Schema::dropIfExists('residentes_has_inmuebles');
    }
}
