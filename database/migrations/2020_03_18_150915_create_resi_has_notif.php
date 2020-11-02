<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResiHasNotif extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resi_has_notif', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_residente');
            $table->unsignedBigInteger('id_notificacion');
            $table->enum('status',['Enviada','Recibida','Respondida'])->default('Enviada');

            $table->foreign('id_residente')->references('id')->on('residentes')->onDelete('cascade');
            $table->foreign('id_notificacion')->references('id')->on('notificaciones')->onDelete('cascade');
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
        Schema::dropIfExists('resi_has_notif');
    }
}
