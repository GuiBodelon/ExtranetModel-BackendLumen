<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApiRegEventosPagos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
            Schema::create('api_reg_eventos_pagos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('numero_evento');
            $table->string('codigo_evento');
            $table->string('valor_evento_conhecido');
            $table->string('valor_evento_pago');
            $table->string('valor_recuperaçao');
            $table->string('valor_glosa');
            $table->string('data_aviso_evento');
            $table->string('data_ocorrencia_vento');
            $table->string('data_pagamento_evento');
            $table->string('identif_benef_principal');
            $table->string('cpf_benef_principal');
            $table->string('identif_usuario_evento');
            $table->string('cpf_usuario_evento');
            $table->string('numero_contrato');
            $table->string('numero_registro_produto');
            $table->string('tipo_prod');
            $table->string('cpf_cnpj_prest');
            $table->string('nome_razao_social_prest');
            $table->string('tipo_documento');
            $table->string('numero_documento');
            $table->string('tipo_evento');
            $table->string('tipo_modalidade');
            $table->string('data_apuraçao_glosa');
            $table->string('mes_referencia');
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
        Schema::dropIfExists('api_reg_eventos_pagos');
    }
}
