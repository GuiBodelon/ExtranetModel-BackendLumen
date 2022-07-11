<?php

namespace App\Http\Controllers\Governanca;

use App\Models\Governanca;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;
use DB;

class GovernancaController extends BaseController
{
    /**
     * Get Conta
     *
     * @return void
     */

     public function getFormulas(Request $request)
     {
        /*return response()->json([
            "contas" => Governanca::whereBetween('DT_HISTORICO', array(
                    \DB::raw("TO_DATE('01/04/2022','DD/MM/YYYY')"),
                    \DB::raw("TO_DATE('29/04/2022','DD/MM/YYYY')")
                )
            )
            ->get(\DB::raw("TO_CHAR(DT_HISTORICO, 'YYYY') DT_HISTORICO"))
        ]);*/

        $mesref = $request->mesref;

        $formulas = DB::connection('oracle_smartadm')->setDateFormat('DD/MM/YYYY')->select("SELECT FORMULA_SIGLA, LTRIM(TO_CHAR(VALOR, '99999999999999999990.999')) VALOR, MESREF, FORMULA_FK FROM API_INDICADORES_RN443 WHERE MESREF = '$mesref'");
        /*$formulas = Governanca::where(\DB::raw("REPLACE(MESREF, '/', '')"), "$mesref")        
        ->get(TO_CHAR(VALOR, '99999999999999999990.999'));*/

        return response()->json($formulas);
     }

     public function getFormulaDetalhe(Request $request)
    {
        $id = $request->id;
        $detalhe = DB::connection('oracle_smartadm')->setDateFormat('DD/MM/YYYY')->select("SELECT * FROM API_FORMULA_DETALHE WHERE ID = $id");
        
        return response()->json($detalhe);
    }

    //--1. MARGEM DE LUCRO LÍQUIDA (MLL) 
     public function getMLL(Request $request)
    {
        $id = $request->id;
        $MLL = DB::connection('oracle_smartadm')->setDateFormat('DD/MM/YYYY')->select("SELECT MLL, TO_CHAR(CONTA_3, 'FM9G999G999G999G999D999', 'NLS_NUMERIC_CHARACTERS='',.''') CONTA_3, TO_CHAR(CONTA_4, 'FM9G999G999G999G999D999', 'NLS_NUMERIC_CHARACTERS='',.''') CONTA_4, TO_CHAR(CONTA_3111, 'FM9G999G999G999G999D999', 'NLS_NUMERIC_CHARACTERS='',.''') CONTA_3111, TO_CHAR(CONTA_3119, 'FM9G999G999G999G999D999', 'NLS_NUMERIC_CHARACTERS='',.''') CONTA_3119, PERIODO_INICIAL, PERIODO_FINAL, DETALHE_FK FROM INDICADOR_MLL WHERE ID = $id");
        
        return response()->json($MLL);
    }
    
    //2. RETORNO SOBRE O PATRIMÔNIO LÍQUIDO(ROE)
    public function getROE(Request $request)
   {
       $id = $request->id;
       $ROE = DB::connection('oracle_smartadm')->setDateFormat('DD/MM/YYYY')->select("SELECT ROE, TO_CHAR(CONTA_3, 'FM9G999G999G999G999D999', 'NLS_NUMERIC_CHARACTERS='',.''') CONTA_3, TO_CHAR(CONTA_4, 'FM9G999G999G999G999D999', 'NLS_NUMERIC_CHARACTERS='',.''') CONTA_4, TO_CHAR(CONTA_25, 'FM9G999G999G999G999D999', 'NLS_NUMERIC_CHARACTERS='',.''') CONTA_25, PERIODO_INICIAL, PERIODO_FINAL, DETALHE_FK FROM INDICADOR_ROE WHERE ID = $id");
       
       return response()->json($ROE);
   }

    //3.PERCENTUAL DE DESPESAS ASSISTENCIAIS EM RELAÇÃO ÀS RECEITAS DE CONTRAPRESTAÇÕES (DM)
    public function getDM(Request $request)
    {
        $id = $request->id;
        $DM = DB::connection('oracle_smartadm')->setDateFormat('DD/MM/YYYY')->select("SELECT DM, TO_CHAR(CONTA_41, 'FM9G999G999G999G999D999', 'NLS_NUMERIC_CHARACTERS='',.''') CONTA_41, TO_CHAR(CONTA_3117, 'FM9G999G999G999G999D999', 'NLS_NUMERIC_CHARACTERS='',.''') CONTA_3117, TO_CHAR(CONTA_3119, 'FM9G999G999G999G999D999', 'NLS_NUMERIC_CHARACTERS='',.''') CONTA_3111, CONTA_3119, PERIODO_INICIAL, PERIODO_FINAL, DETALHE_FK FROM INDICADOR_DM WHERE ID = $id");
        
        return response()->json($DM);
    }

    //4.PERCENTUAL DE DESPESAS ADMINISTRATIVAS EM RELAÇÃO ÀS RECEITAS DE CONTRAPRESTAÇÕES (DA)
    public function getDA(Request $request)
    {
        $id = $request->id;
        $DA = DB::connection('oracle_smartadm')->setDateFormat('DD/MM/YYYY')->select("SELECT DA, TO_CHAR(CONTA_46, 'FM9G999G999G999G999D999', 'NLS_NUMERIC_CHARACTERS='',.''') CONTA_46, TO_CHAR(CONTA_3111, 'FM9G999G999G999G999D999', 'NLS_NUMERIC_CHARACTERS='',.''') CONTA_3111, TO_CHAR(CONTA_3119, 'FM9G999G999G999G999D999', 'NLS_NUMERIC_CHARACTERS='',.''') CONTA_3119, PERIODO_INICIAL, PERIODO_FINAL, DETALHE_FK FROM INDICADOR_DA WHERE ID = $id");
        
        return response()->json($DA);
    }

    //5 - NÃO EXISTE

    //6 PERCENTUAL DE DESPESAS OPERACIONAIS EM RELAÇÃO ÀS RECEITAS OPERACIONAIS (DOP)
    public function getDOP(Request $request)
    {
        $id = $request->id;
        $DOP = DB::connection('oracle_smartadm')->setDateFormat('DD/MM/YYYY')->select("SELECT DOP, TO_CHAR(CONTA_41, 'FM9G999G999G999G999D999', 'NLS_NUMERIC_CHARACTERS='',.''') CONTA_41, TO_CHAR(CONTA_44, 'FM9G999G999G999G999D999', 'NLS_NUMERIC_CHARACTERS='',.''') CONTA_44, TO_CHAR(CONTA_46, 'FM9G999G999G999G999D999', 'NLS_NUMERIC_CHARACTERS='',.''') CONTA_46, TO_CHAR(CONTA_3117, 'FM9G999G999G999G999D999', 'NLS_NUMERIC_CHARACTERS='',.''') CONTA_3117, TO_CHAR(CONTA_3111, 'FM9G999G999G999G999D999', 'NLS_NUMERIC_CHARACTERS='',.''') CONTA_3111, TO_CHAR(CONTA_3119, 'FM9G999G999G999G999D999', 'NLS_NUMERIC_CHARACTERS='',.''') CONTA_3119, TO_CHAR(CONTA_33, 'FM9G999G999G999G999D999', 'NLS_NUMERIC_CHARACTERS='',.''') CONTA_33, PERIODO_INICIAL, PERIODO_FINAL, DETALHE_FK FROM INDICADOR_DOP WHERE ID = $id");
        
        return response()->json($DOP);
    }

    //7 ÍNDICE DE RESULTADO FINANCEIRO (IRF)
    public function getIRF(Request $request)
    {
        $id = $request->id;
        $IRF = DB::connection('oracle_smartadm')->setDateFormat('DD/MM/YYYY')->select("SELECT IRF, TO_CHAR(CONTA_35, 'FM9G999G999G999G999D999', 'NLS_NUMERIC_CHARACTERS='',.''') CONTA_35, TO_CHAR(CONTA_45, 'FM9G999G999G999G999D999', 'NLS_NUMERIC_CHARACTERS='',.''') CONTA_45, TO_CHAR(CONTA_3111, 'FM9G999G999G999G999D999', 'NLS_NUMERIC_CHARACTERS='',.''') CONTA_3111, TO_CHAR(CONTA_3119, 'FM9G999G999G999G999D999', 'NLS_NUMERIC_CHARACTERS='',.''') CONTA_3119, PERIODO_INICIAL, PERIODO_FINAL, DETALHE_FK FROM INDICADOR_IRF WHERE ID = $id");
        
        return response()->json($IRF);
    }

    //8 LIQUIDEZ CORRENTE (LC)
    public function getLC(Request $request)
    {
        $id = $request->id;
        $LC = DB::connection('oracle_smartadm')->setDateFormat('DD/MM/YYYY')->select("SELECT LC, TO_CHAR(CONTA_12, 'FM9G999G999G999G999D999', 'NLS_NUMERIC_CHARACTERS='',.''') CONTA_12, TO_CHAR(CONTA_21, 'FM9G999G999G999G999D999', 'NLS_NUMERIC_CHARACTERS='',.''')  CONTA_21, PERIODO_INICIAL, PERIODO_FINAL, DETALHE_FK FROM INDICADOR_LC WHERE ID = $id");
        
        return response()->json($LC);
    }

    //9 CAPITAL DE TERCEIROS SOBRE O CAPITAL PRÓPRIO (CT/CP)
    public function getCTCP(Request $request)
    {
        $id = $request->id;
        $CTCP = DB::connection('oracle_smartadm')->setDateFormat('DD/MM/YYYY')->select("SELECT CT_CP, TO_CHAR(CONTA_21, 'FM9G999G999G999G999D999', 'NLS_NUMERIC_CHARACTERS='',.''') CONTA_21, TO_CHAR(CONTA_23, 'FM9G999G999G999G999D999', 'NLS_NUMERIC_CHARACTERS='',.''') CONTA_23, TO_CHAR(CONTA_25, 'FM9G999G999G999G999D999', 'NLS_NUMERIC_CHARACTERS='',.''') CONTA_25, PERIODO_INICIAL, PERIODO_FINAL, DETALHE_FK FROM INDICADOR_CT_CP WHERE ID = $id");
        
        return response()->json($CTCP);
    }

    //10 PRAZO MÉDIO DE RECEBIMENTO DE CONTRAPRESTAÇÕES (PMRC)
    public function getPMRC(Request $request)
    {
        $id = $request->id;
        $PMRC = DB::connection('oracle_smartadm')->setDateFormat('DD/MM/YYYY')->select("SELECT PMRC, TO_CHAR(CONTA_12311, 'FM9G999G999G999G999D999', 'NLS_NUMERIC_CHARACTERS='',.''') CONTA_12311, TO_CHAR(CONTA_3111, 'FM9G999G999G999G999D999', 'NLS_NUMERIC_CHARACTERS='',.''') CONTA_3111, TO_CHAR(CONTA_3119, 'FM9G999G999G999G999D999', 'NLS_NUMERIC_CHARACTERS='',.''') CONTA_3119, PERIODO_INICIAL, PERIODO_FINAL, DETALHE_FK FROM INDICADOR_PMRC WHERE ID = $id");
        
        return response()->json($PMRC);
    }

    //11 PRAZO MÉDIO DE PAGAMENTO DE EVENTOS (PMPE)
    public function getPMPE(Request $request)
    {
        $id = $request->id;
        $PMPE = DB::connection('oracle_smartadm')->setDateFormat('DD/MM/YYYY')->select("SELECT PMPE, TO_CHAR(CONTA_21111_103, 'FM9G999G999G999G999D999', 'NLS_NUMERIC_CHARACTERS='',.''') CONTA_21111_103, TO_CHAR(CONTA_2135, 'FM9G999G999G999G999D999', 'NLS_NUMERIC_CHARACTERS='',.''') CONTA_2135, TO_CHAR(CONTA_41, 'FM9G999G999G999G999D999', 'NLS_NUMERIC_CHARACTERS='',.''') CONTA_41 , TO_CHAR(CONTA_4118, 'FM9G999G999G999G999D999', 'NLS_NUMERIC_CHARACTERS='',.''') CONTA_4118, TO_CHAR(CONTA_414, 'FM9G999G999G999G999D999', 'NLS_NUMERIC_CHARACTERS='',.''') CONTA_414, TO_CHAR(CONTA_3117, 'FM9G999G999G999G999D999', 'NLS_NUMERIC_CHARACTERS='',.''') CONTA_3117, PERIODO_INICIAL, PERIODO_FINAL, DETALHE_FK FROM INDICADOR_PMPE WHERE ID = $id");
        
        return response()->json($PMPE);
    }

    //12 VARIAÇÃO DE CUSTOS (VC)
    public function getVC(Request $request)
    {
        $id = $request->id;
        $VC = DB::connection('oracle_smartadm')->setDateFormat('DD/MM/YYYY')->select("SELECT VC, TO_CHAR(CONTA_41, 'FM9G999G999G999G999D999', 'NLS_NUMERIC_CHARACTERS='',.''') CONTA_41, TO_CHAR(CONTA_414, 'FM9G999G999G999G999D999', 'NLS_NUMERIC_CHARACTERS='',.''') CONTA_414, TO_CHAR(CONTA_3117, 'FM9G999G999G999G999D999', 'NLS_NUMERIC_CHARACTERS='',.''') CONTA_3117, PERIODO_INICIAL, PERIODO_FINAL, DETALHE_FK FROM INDICADOR_VC WHERE ID = $id");
        
        return response()->json($VC);
    }

    ///////////////////////////INDICADORES ADICIONAIS
    //14 RENTABILIDADE DOS ATIVOS % (ROA)
    public function getROA(Request $request)
    {
        $id = $request->id;
        $ROA = DB::connection('oracle_smartadm')->setDateFormat('DD/MM/YYYY')->select("SELECT ROA, TO_CHAR(CONTA_3, 'FM9G999G999G999G999D999', 'NLS_NUMERIC_CHARACTERS='',.''') CONTA_3, TO_CHAR(CONTA_4, 'FM9G999G999G999G999D999', 'NLS_NUMERIC_CHARACTERS='',.''') CONTA_4, TO_CHAR(CONTA_1, 'FM9G999G999G999G999D999', 'NLS_NUMERIC_CHARACTERS='',.''') CONTA_1, TO_CHAR(CONTA_19, 'FM9G999G999G999G999D999', 'NLS_NUMERIC_CHARACTERS='',.''') CONTA_19, PERIODO_INICIAL, PERIODO_FINAL, DETALHE_FK FROM INDICADOR_ROA WHERE ID = $id");
        
        return response()->json($ROA);
    }

    //15 LIQUIDEZ GERAL (LG)
    public function getLG(Request $request)
    {
        $id = $request->id;
        $LG = DB::connection('oracle_smartadm')->setDateFormat('DD/MM/YYYY')->select("SELECT LG, TO_CHAR(CONTA_12, 'FM9G999G999G999G999D999', 'NLS_NUMERIC_CHARACTERS='',.''') CONTA_12, TO_CHAR(CONTA_131, 'FM9G999G999G999G999D999', 'NLS_NUMERIC_CHARACTERS='',.''') CONTA_131, TO_CHAR(CONTA_21, 'FM9G999G999G999G999D999', 'NLS_NUMERIC_CHARACTERS='',.''') CONTA_21, TO_CHAR(CONTA_23, 'FM9G999G999G999G999D999', 'NLS_NUMERIC_CHARACTERS='',.''') CONTA_23, PERIODO_INICIAL, PERIODO_FINAL, DETALHE_FK FROM INDICADOR_LG WHERE ID = $id");
        
        return response()->json($LG);
    }

    //16 LIQUIDEZ IMEDIATA (LI)
    public function getLI(Request $request)
    {
        $id = $request->id;
        $LI = DB::connection('oracle_smartadm')->setDateFormat('DD/MM/YYYY')->select("SELECT LI, TO_CHAR(CONTA_1214, 'FM9G999G999G999G999D999', 'NLS_NUMERIC_CHARACTERS='',.''') CONTA_1214, TO_CHAR(CONTA_122, 'FM9G999G999G999G999D999', 'NLS_NUMERIC_CHARACTERS='',.''') CONTA_122, TO_CHAR(CONTA_21, 'FM9G999G999G999G999D999', 'NLS_NUMERIC_CHARACTERS='',.''') CONTA_21, PERIODO_INICIAL, PERIODO_FINAL, DETALHE_FK FROM INDICADOR_LI WHERE ID = $id");
        
        return response()->json($LI);
    }

    //17 DESPESAS ADMINISTRATIVAS S/ RESULTADO OPER. ASSIST. SAÚDE (EA)
    public function getEA(Request $request)
    {
        $id = $request->id;
        $EA = DB::connection('oracle_smartadm')->setDateFormat('DD/MM/YYYY')->select("SELECT EA, TO_CHAR(CONTA_46, 'FM9G999G999G999G999D999', 'NLS_NUMERIC_CHARACTERS='',.''') CONTA_46, TO_CHAR(CONTA_3111, 'FM9G999G999G999G999D999', 'NLS_NUMERIC_CHARACTERS='',.''') CONTA_3111, TO_CHAR(CONTA_3119, 'FM9G999G999G999G999D999', 'NLS_NUMERIC_CHARACTERS='',.''') CONTA_3119, TO_CHAR(CONTA_41, 'FM9G999G999G999G999D999', 'NLS_NUMERIC_CHARACTERS='',.''') CONTA_41, TO_CHAR(CONTA_3117, 'FM9G999G999G999G999D999', 'NLS_NUMERIC_CHARACTERS='',.''') CONTA_3117, PERIODO_INICIAL, PERIODO_FINAL, DETALHE_FK FROM INDICADOR_EA WHERE ID = $id");
        
        return response()->json($EA);
    }

    //18 DESPESAS DA FOLHA DE PESSOAL S/ RESULTADO DAS OPERAÇÕES DE ASSIST. À SAÚDE (EFP)
    public function getEFP(Request $request)
    {
        $id = $request->id;
        $EFP = DB::connection('oracle_smartadm')->setDateFormat('DD/MM/YYYY')->select("SELECT EFP, TO_CHAR(CONTA_461, 'FM9G999G999G999G999D999', 'NLS_NUMERIC_CHARACTERS='',.''') CONTA_461, TO_CHAR(CONTA_3111, 'FM9G999G999G999G999D999', 'NLS_NUMERIC_CHARACTERS='',.''') CONTA_3111, TO_CHAR(CONTA_3119, 'FM9G999G999G999G999D999', 'NLS_NUMERIC_CHARACTERS='',.''') CONTA_3119, TO_CHAR(CONTA_41, 'FM9G999G999G999G999D999', 'NLS_NUMERIC_CHARACTERS='',.''') CONTA_41, TO_CHAR(CONTA_3117, 'FM9G999G999G999G999D999', 'NLS_NUMERIC_CHARACTERS='',.''') CONTA_3117, PERIODO_INICIAL, PERIODO_FINAL, DETALHE_FK FROM INDICADOR_EFP WHERE ID = $id");
        
        return response()->json($EFP);
    }

    //19 CAPITAL CIRCULANTE LIQUIDO (CCL)
    public function getCCL(Request $request)
    {
        $id = $request->id;
        $CCL = DB::connection('oracle_smartadm')->setDateFormat('DD/MM/YYYY')->select("SELECT TO_CHAR(CCL, 'FM9G999G999G999G999D999', 'NLS_NUMERIC_CHARACTERS='',.''') CCL, TO_CHAR(CONTA_12, 'FM9G999G999G999G999D999', 'NLS_NUMERIC_CHARACTERS='',.''') CONTA_12, TO_CHAR(CONTA_21, 'FM9G999G999G999G999D999', 'NLS_NUMERIC_CHARACTERS='',.''') CONTA_21, PERIODO_INICIAL, PERIODO_FINAL, DETALHE_FK FROM INDICADOR_CCL WHERE ID = $id");
        
        return response()->json($CCL);
    }

    //20 SUFICIÊNCIA DO PATRIMÔNIO LÍQUIDO AJUSTADO (PLA)
    public function getPLA(Request $request)
    {
        $id = $request->id;
        $PLA = DB::connection('oracle_smartadm')->setDateFormat('DD/MM/YYYY')->select("SELECT TO_CHAR(PLA, 'FM9G999G999G999G999D999', 'NLS_NUMERIC_CHARACTERS='',.''') PLA, TO_CHAR(CONTA_25, 'FM9G999G999G999G999D999', 'NLS_NUMERIC_CHARACTERS='',.''') CONTA_25, TO_CHAR(CONTA_128, 'FM9G999G999G999G999D999', 'NLS_NUMERIC_CHARACTERS='',.''') CONTA_128, TO_CHAR(CONTA_134, 'FM9G999G999G999G999D999', 'NLS_NUMERIC_CHARACTERS='',.''') CONTA_134, PERIODO_INICIAL, PERIODO_FINAL, DETALHE_FK FROM INDICADOR_PLA WHERE ID = $id");
        
        return response()->json($PLA);
    }

}