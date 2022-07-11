<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApiLogPreview extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('api_log_preview', function (Blueprint $table) {
            $table->increments('id_preview');
            $table->string('nome_tabela_preview');
            $table->string('tipo_tabela_preview');
            $table->string('data_manuseio_preview');
            $table->string('nome_arquivo');
            $table->string('usuario');
            $table->string('status_preview');
            $table->string('acoes_preview');
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
        Schema::dropIfExists('api_log_preview');
    }
}
