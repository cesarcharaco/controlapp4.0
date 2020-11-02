<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResiHasNotic extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resi_has_notic', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_residente');
            $table->unsignedBigInteger('id_noticia');
            $table->enum('status',['Recibida','No Recibida'])->default('No Recibida');

            $table->foreign('id_residente')->references('id')->on('residentes')->onDelete('cascade');
            $table->foreign('id_noticia')->references('id')->on('noticias')->onDelete('cascade');
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
        Schema::dropIfExists('resi_has_notic');
    }
}
