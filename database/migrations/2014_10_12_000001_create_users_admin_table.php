<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersAdminTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_admin', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('rut');
            $table->string('email')->unique();
            $table->enum('status',['activo','suspendido'])->default('activo');
            $table->unsignedBigInteger('id_membresia');

            $table->foreign('id_membresia')->references('id')->on('membresias')->onDelete('cascade');
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
        Schema::dropIfExists('users_admin');
    }
}
