<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImgsNoticiasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imgs_noticias', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_noticia');
            $table->string('url');
            $table->string('img');

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
        Schema::dropIfExists('imgs_noticias');
    }
}
