<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminsHasPasarelasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins_has_pasarelas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_pasarela');
            $table->unsignedBigInteger('id_admin');
            $table->string('link_pasarela');

            $table->foreign('id_pasarela')->references('id')->on('pasarelas')->onDelete('cascade');
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
        Schema::dropIfExists('admins_has_pasarelas');
    }
}
