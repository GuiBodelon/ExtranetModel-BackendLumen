<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    /*
    public function up()
    {
        Schema::create('api_usuarios', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('nome');
            $table->string('cargo');

            $table->timestamps();

            $table->integer('fk_setor');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    /*
    public function down()
    {
        Schema::dropIfExists('api_usuarios');
    }*/
}