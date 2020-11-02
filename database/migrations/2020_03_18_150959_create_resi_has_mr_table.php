<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResiHasMrTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resi_has_mr', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_residente');
            $table->unsignedBigInteger('id_mr');
            $table->integer('mes');
            $table->enum('status',['Enviada','Pagada','Por Confirmar'])->default('Enviada');
            $table->string('referencia')->nullable();

            $table->foreign('id_residente')->references('id')->on('residentes')->onDelete('cascade');
            $table->foreign('id_mr')->references('id')->on('multas_recargas')->onDelete('cascade');
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
        Schema::dropIfExists('resi_has_mr');
    }
}
