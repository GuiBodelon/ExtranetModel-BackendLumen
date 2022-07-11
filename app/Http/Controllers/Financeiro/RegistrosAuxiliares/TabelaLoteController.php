<?php

namespace App\Http\Controllers\Financeiro\RegistrosAuxiliares;

use App\Models\Financeiro\RegistrosAuxiliares\TabelaLote;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;
use DB;

class TabelaLoteController extends BaseController
{   
    public function index(Request $request){
        $tipoOperacao = $request->tipoOperacao;
        $mesref = $request->mesref;

        if($tipoOperacao == 'C'){
            $consulta = 'WHERE B.ID IN (1, 2, 3, 4, 5, 6)';
        }else if($tipoOperacao == 'O'){
            $consulta = 'WHERE B.ID IN (10, 20, 30, 40, 50, 60)';
        }else{
            $consulta = "WHERE B.ID = '$tipoOperacao' AND MES_REF = '$mesref'";
        }

        $feedTabela = DB::connection('oracle_spasaude')->select(
            "SELECT A.ID LOTE, B.DESCRICAO DESCRICAO, MES_REF MESREF, OPERADOR, TO_CHAR(DATA_SISTEMA, 'DD/MM/YYYY - HH24:MI:SS') DATA_SISTEMA, C.DESCRICAO STATUS 
            FROM REGISTROS_AUX_LOTE A
            INNER JOIN REGISTROS_AUX_OPERACOES B ON (A.FK_OPERACAO_REG_AUX = B.ID)
            INNER JOIN REGISTROS_AUX_LOTE_STATUS C ON(C.ID = A.FK_STATUS) 
            $consulta ORDER BY 1 DESC"
        );

        return response()->json($feedTabela);
    }
}