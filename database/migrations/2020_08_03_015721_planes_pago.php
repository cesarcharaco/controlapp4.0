<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PlanesPago extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('planes_pago', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre');
            $table->string('monto');
            $table->string('dias');
            $table->string('nombre_img');
            $table->string('url_img');
            $table->string('color');
            $table->string('tipo');
            $table->enum('status',['Activo','Inactivo'])->default('Activo');
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
        
    }
}
