<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagosEstacTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagos_estac', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_mens_estac');
            $table->enum('status',['Cancelado','Pendiente','No Aplica','Por Confirmar'])->default('Pendiente');

            $table->foreign('id_mens_estac')->references('id')->on('mens_estac');
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
        Schema::dropIfExists('pagos_estac');
    }
}
