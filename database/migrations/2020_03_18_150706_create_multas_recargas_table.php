<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMultasRecargasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('multas_recargas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('motivo');
            $table->text('observacion')->nullable();
            $table->float('monto');
            $table->enum('tipo',['Multa','Recarga']);
            $table->integer('anio');
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
        Schema::dropIfExists('multas_recargas');
    }
}
