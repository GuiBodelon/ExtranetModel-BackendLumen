<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApiTnummMedicamentos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('api_tnumm_medicamentos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('codigo');
            $table->string('tiss_tp_tabela');
            $table->string('tiss_codigo_medicamento');
            $table->string('nome_comercial');
            $table->string('principio_ativo');
            $table->string('generico');
            $table->string('grupo_farmacologico');
            $table->string('classe_farmacologica');
            $table->string('forma_farmaceutica');
            $table->string('unid_min_fracao');
            $table->string('cnpj_detentor_registro_anvisa');
            $table->string('detentor_registro_anvisa');
            $table->string('registro_anvisa');
            $table->string('valor');
            $table->string('observacoes');
            $table->string('tiss_cod_anterior');
            $table->string('cod_anterior');
            $table->string('tipo_produto');
            $table->string('tipo_codificacao');
            $table->string('data_vigencia_informada');
            $table->string('data_inicio_vigencia');
            $table->string('data_fim_vigencia');
            $table->string('motivo_insercao');
            $table->string('data_fim_implantacao');
            $table->string('cod_tiss_brasindice');
            $table->string('desricao_brasindice');
            $table->string('apresentacao_brasindice');
            $table->string('status');
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
        Schema::dropIfExists('api_tnumm_medicamentos');
    }
}
