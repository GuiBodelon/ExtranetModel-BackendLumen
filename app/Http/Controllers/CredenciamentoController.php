<?php

namespace App\Http\Controllers;

use App\Models\Credenciamento\ImportacaoTabelas\tnumm_materiais;
use App\Models\Credenciamento\ImportacaoTabelas\tnumm_materiais_tmp;
use App\Models\Credenciamento\ImportacaoTabelas\tnumm_medicamentos;
use App\Models\Credenciamento\ImportacaoTabelas\log_preview;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;
use DB;

class credenciamentoController extends BaseController
{

    /*  Funcoes responsaveis pelo ciclo tabela api_log_preview */
   
     public function index(Request $request)

        {

            $resultado = log_preview::orderBy('id_preview') 
            ->where('status_preview', '<>', 'Deletado')
            ->get();
        
            return $resultado;

        }

     public function store(Request $request)

        {

            $nomeTabelaPreview = $request->nome_tabela_preview;
            $tipoTabelaPreview = $request->tipo_tabela_preview;
            $dataManuseioPreview = $request->data_manuseio_preview;
            $nomeArquivo = $request->nome_arquivo;
            $usuario = $request->usuario;
            $stausPreview = $request->status_preview;
            $acoesPreview = $request->acoes_preview;

            $sqlInsertLogPreview = DB::connection('oracle_esaude_homolog')->insert("INSERT INTO api_log_preview (ID_PREVIEW,
            NOME_TABELA_PREVIEW, TIPO_TABELA_PREVIEW, DATA_MANUSEIO_PREVIEW, NOME_ARQUIVO, USUARIO, STATUS_PREVIEW, 
            ACOES_PREVIEW, CREATED_AT, UPDATED_AT)
            VALUES (SEQ_LOG_PREVIEW.NEXTVAL, '$nomeTabelaPreview', '$tipoTabelaPreview', '$dataManuseioPreview', '$nomeArquivo', '$usuario', 
            '$stausPreview', '$acoesPreview', SYSDATE, '')");

            return response()
            ->json('Inserido', 201);
        }


     public function delete($id_preview)

        {
            
            $sqlDeleteLogPreview = DB::connection('oracle_esaude_homolog')->update("UPDATE api_log_preview SET STATUS_PREVIEW = 'Deletado' WHERE ID_PREVIEW = $id_preview");
            return 'apagado id ' . $id_preview ;
        }


                    /*  Fim Funcoes responsaveis pelo ciclo tabela api_log_preview */
        /* =================================================================================== */



        
        /*  Funcoes responsaveis pelo ciclo tabela tnumm_materiais_tmp */

        public function selectTnummMateriaisTmp (Request $request){


            $select_tnumm_materiais_tmp = tnumm_materiais_tmp::all();
        
            return $select_tnumm_materiais_tmp;

        }


}