<?php

namespace App\Http\Controllers\Financeiro\RegistrosAuxiliares;

use App\Models\Financeiro\RegistrosAuxiliares\NovoRegistro;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;
use DB;

class NovoRegistroController extends BaseController
{   
    public function gerarNovoRegistroConferencia(Request $request){

        $currentUser = auth()->user();
        $usuario = $currentUser['nome'];
        $mesref = $request->mesref;
        $operacao = $request->operacao;
        
        $p1 = strtoupper($usuario);
        $p2 = $mesref;
        $p3 = $operacao;

        $novoRegistroProcedure = 'REGISTROS_AUXILIARES.CRIA_LOTE_PROCESSAMENTO';

        $bindings = [
            'p1'  => $p1, //Usuário
            'p2'  => $p2, //Mesref
            'p3'  => $p3 //Operacao FK
        ];

        $result = DB::connection('oracle_spasaude')->executeProcedure($novoRegistroProcedure, $bindings);
        return response()->json(['operacao' => $operacao, 'result' => $result]);
    }

    public function gerarRegistroOficial(Request $request){
        $currentUser = auth()->user();
        $usuario = $currentUser['nome'];
        $lote = $request->lote;

        $infoRegistroConferencia = DB::connection('oracle_spasaude')
        ->select("SELECT FK_OPERACAO_REG_AUX ID_CONFERENCIA, MES_REF FROM REGISTROS_AUX_LOTE A INNER JOIN REGISTROS_AUX_OPERACOES B ON (A.FK_OPERACAO_REG_AUX = B.ID) WHERE A.ID = $lote");

        foreach ($infoRegistroConferencia as $registro) {
            $operacao = $registro->id_conferencia;
            $mesref = $registro->mes_ref;
        }

        switch($operacao){
            //CONFERÊNCIA - EVENTOS E GLOSAS -> OFICIAL - EVENTOS E GLOSAS
            case '1': $operacao = '10';        
            break;
            //CONFERÊNCIA - CO-PARTICIPAÇÃO -> OFICIAL - CO-PARTICIPAÇÃO
            case '2': $operacao = '20';     
            break;
            //CONFERÊNCIA - CORREÇÃO DE COPARTICIPAÇÃO -> OFICIAL - CORREÇÃO DE COPARTICIPAÇÃO
            case '3': $operacao = '30';     
            break;
            //CONFERÊNCIA - BI/PENTAHO' -> NULO POIS NÃO POSSUI REGISTRO OFICIAL, APENAS VISUALIZAÇÃO NO PENTAHO;
            case '4': $operacao = '';
            break;
            //CONFERÊNCIA - CONTRAPRESTAÇÃO EMITIDA -> OFICIAL - CONTRAPRESTAÇÃO EMITIDA
            case '5': $operacao = '50';
            break;
            //CONFERÊNCIA - CONTRAPRESTAÇÃO RECEBIDA -> OFICIAL - CONTRAPRESTAÇÃO RECEBIDA
            case '6': $operacao = '60';
            break;
        };

        $checkRegistro = DB::connection('oracle_spasaude')
        ->select("SELECT A.ID LOTE, B.DESCRICAO DESCRICAO, MES_REF MESREF, OPERADOR, TO_CHAR(DATA_SISTEMA, 'DD/MM/YYYY - HH24:MI:SS') DATA_SISTEMA, C.DESCRICAO STATUS , TIPO
                FROM REGISTROS_AUX_LOTE A
                INNER JOIN REGISTROS_AUX_OPERACOES B ON (A.FK_OPERACAO_REG_AUX = B.ID)
                INNER JOIN REGISTROS_AUX_LOTE_STATUS C ON(C.ID = A.FK_STATUS)
                WHERE B.ID = '$operacao' AND MES_REF = '$mesref'");

        //LOOP PARA MONTAR O DATA RESPONSE
        foreach ($checkRegistro as $registro) {
            $descricaoMensagem = $registro->descricao;
            $operadorMensagem = $registro->operador;
            $mesrefMensagem = $registro->mesref;
        }

        //CHECAR SE O REGISTRO OFICIAL RESPECTIVO AO REGISTRO DE CONFERÊNCIA JA EXISTE
        if (count($checkRegistro) === 0) {
            //Não existe -> Rodar procedure            
            $novoRegistroProcedure = 'REGISTROS_AUXILIARES.CRIA_LOTE_PROCESSAMENTO';

            $p1 = strtoupper($usuario);
            $p2 = substr_replace($mesref, '/', 2, 0); //Inserir "/" entre mês e ano.
            $p3 = $operacao;

            $bindings = [
                'p1'  => $p1, //Usuário
                'p2'  => $p2, //Mesref
                'p3'  => $p3 //Operacao FK
            ];

            //$result = DB::connection('oracle_spasaude')->executeProcedure($novoRegistroProcedure, $bindings);

            //RESPONSE ARRAY
            $arrayCheckRegistro[] = array(
                'registroExistente' => 'false',
                'mensagem' => "Registro Oficial gerado com sucesso!"
            );

            $json_array = json_encode($arrayCheckRegistro);
            print_r($json_array);

        }else{
            //Existe -> Verificar se usuário deseja sobrescrever o registro
            $arrayCheckRegistro[] = array(
                'registroExistente' => 'true',
                'mensagem' => "REGISTRO $descricaoMensagem gerado pelo usuário $operadorMensagem com mês de referência: $mesrefMensagem. Você tem certeza que deseja sobrescrever o registro?"
            );

            $json_array = json_encode($arrayCheckRegistro);
            print_r($json_array);

            //Caso o usuário confirmar a ação -> Executar procedure para gerar novo registro
            /*if($responseUser == true){
                $result = DB::connection('oracle_spasaude')->executeProcedure($novoRegistroProcedure, $bindings);

                //ARRAY RESPONSE
                $arrayCheckRegistro[] = array(
                    'mensagem' => "REGISTRO $descricaoMensagem foi sobrescrito com sucesso!"
                );
                $json_array = json_encode($arrayCheckRegistro);
                print_r($json_array);
            }*/
        }
    }

    public function registrarLogOperacao(Request $request){
        //$lote = $request->lote;

        //$registrarLog = "BEGIN REGISTROS_AUXILIARES.REGISTRA_LOG_REG_AUXILIAR('$lote', '4', '$usuario', '$operacao');END;";
        //DB::connection('oracle_spasaude')->getPdo()->exec($registrarLog);

        //REGISTRAR LOG DA OPERAÇÃO  
        /*      
        $p1 = $lote;
        $p2 = '4'; //Status PROCESSAMENTO CONCLUÍDO
        $p3 = $usuario;
        $p4 = $operacao;

        $stmt = $pdo->prepare("BEGIN REGISTROS_AUXILIARES.REGISTRA_LOG_REG_AUXILIAR(:p1, :p2, :p3, :p4); END;");
        $stmt->bindParam(':p1', $p1, PDO::PARAM_INT);
        $stmt->bindParam(':p2', $p2, PDO::PARAM_INT);
        $stmt->bindParam(':p3', $p3, PDO::PARAM_INT);
        $stmt->bindParam(':p4', $p4, PDO::PARAM_INT);
        $stmt->execute(); 
        */
    }
}