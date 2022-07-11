<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApiTnummMateriaisTmp extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('api_tnumm_materiais_tmp', function (Blueprint $table) {
            $table->increments('id');
            $table->string('codigo');
            $table->string('tiss_tp_tabela');
            $table->string('tiss_codigo_material');
            $table->string('nome_comercial');
            $table->string('descricao_produto');
            $table->string('especialidade_produto');
            $table->string('classificcao_produto');
            $table->string('nome_tecnico');
            $table->string('unid_min_fracao');
            $table->string('cnpj_detentor_registro_anvisa');
            $table->string('detentor_registro_anvisa');
            $table->string('registro_anvisa');
            $table->string('valor');
            $table->string('observacoes');
            $table->string('tiss_cod_anterior');
            $table->string('cod_anterior');
            $table->string('ref_tamanho_modelo');
            $table->string('tipo_produto');
            $table->string('tipo_codificacao');
            $table->date('data_vigencia_informada');
            $table->string('data_inicio_vigencia');
            $table->string('data_fim_vigencia');
            $table->string('motivo_insercao');
            $table->string('data_fim_implantacao');
            $table->string('cod_simpro');
            $table->string('desricao_produto_simpro');
            $table->string('equivalencia_tecnica');
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
        Schema::dropIfExists('api_tnumm_materiais_tmp');
    }
}
