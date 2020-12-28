<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagosAnunciosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagos_anuncios', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('referencia');
            $table->decimal('monto',11, 2);
            $table->unsignedBigInteger('id_planesA');
            
            $table->foreign('id_planesA')->references('id')->on('planes_has_anuncios')->onDelete('cascade');
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
        Schema::dropIfExists('pagos_anuncios');
    }
}
