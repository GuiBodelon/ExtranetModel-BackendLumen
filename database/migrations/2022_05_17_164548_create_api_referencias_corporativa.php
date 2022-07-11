<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApiReferenciasCorporativa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('api_referencias_corporativa', function (Blueprint $table) {
            $table->increments('id');
            $table->string('razao_social');
            $table->string('cnpj');
            $table->string('registro_ans');
            $table->string('logradouro');
            $table->string('numero');
            $table->string('complemento');
            $table->string('cidade');
            $table->string('bairro');
            $table->string('uf');
            $table->string('cep');
            $table->string('telefone');
            $table->string('email');
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
        Schema::dropIfExists('api_referencias_corporativa');
    }
}
