<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminsHasAnuncios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins_has_anuncios', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_users_admin');
            $table->unsignedBigInteger('id_anuncios');

            $table->foreign('id_users_admin')->references('id')->on('users_admin');
            $table->foreign('id_anuncios')->references('id')->on('anuncios');
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
        Schema::dropIfExists('admins_has_anuncios');
    }
}
