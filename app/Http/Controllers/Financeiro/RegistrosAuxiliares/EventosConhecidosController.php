<?php

namespace App\Http\Controllers\Financeiro\RegistrosAuxiliares;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\Writer\Csv;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Style\Color;
use App\Models\Financeiro\RegistrosAuxiliares\EventosConhecidos;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;
use DB;


$taxa = 2;


class EventosConhecidosController extends BaseController
{

	
    /*  Funcoes  */   
    public function index(Request $request){

           
    }


	public function totalizadorEventosConhecidos(Request $request){

				$lote_fk = $request->FK_REGISTROS_AUX_LOTE;

				//echo($taxa);

				//exit;

				
				// Totalizadores Internações			
				$selectEventosConhecidos = DB::connection('oracle_spasaude')
				->select("SELECT TIPO_EVENTO_ANS, VALOR_PAGAMENTO, VALOR_EVENTO, VALOR_RECUPERACAO, VLR_GLOSA FROM API_REG_AUX_EVENTOS_CONHECIDOS WHERE TIPO_EVENTO_ANS = 'Internações' AND FK_REGISTROS_AUX_LOTE = $lote_fk");

				$tipoEvento = 'Internações';
				$totalPagamentoInternacoes = array_column($selectEventosConhecidos, 'valor_pagamento');
				$totalRecuperadoInternacoes = array_column($selectEventosConhecidos, 'valor_recuperacao');
				$totalEventoInternacoes = array_column($selectEventosConhecidos, 'valor_evento');
				$totalGlosaInternacoes = array_column($selectEventosConhecidos, 'vlr_glosa');

				$pagoInternacoes = (array_sum($totalPagamentoInternacoes));
				$recuperadoInternacoes = (array_sum($totalRecuperadoInternacoes));
				$eventoInternacoes = (array_sum($totalEventoInternacoes));
				$glosaInternacoes = (array_sum($totalGlosaInternacoes));

				$internacoes = array(
					'tipo_evento'=>$tipoEvento,
					'total_evento'=>number_format($eventoInternacoes, 2, ',', '.'),
					'total_recuperado'=>number_format($recuperadoInternacoes, 2, ',', '.'),
					'total_pagamento'=>number_format($pagoInternacoes, 2, ',', '.'),
					'total_glosas'=>number_format($glosaInternacoes, 2, ',', '.')
				);					


				// Totalizadores Terapias
				$selectEventosConhecidos = DB::connection('oracle_spasaude')
				->select("SELECT TIPO_EVENTO_ANS, VALOR_PAGAMENTO, VALOR_EVENTO, VALOR_RECUPERACAO, VLR_GLOSA FROM API_REG_AUX_EVENTOS_CONHECIDOS  WHERE TIPO_EVENTO_ANS = 'Terapias' AND FK_REGISTROS_AUX_LOTE = $lote_fk");

				$tipoEvento = 'Terapias';
				$totalPagamentoTerapias = array_column($selectEventosConhecidos, 'valor_pagamento');
				$totalRecuperadoTerapias = array_column($selectEventosConhecidos, 'valor_recuperacao');
				$totalEventoTerapias = array_column($selectEventosConhecidos, 'valor_evento');
				$totalGlosaTerapias = array_column($selectEventosConhecidos, 'vlr_glosa');

				$totalPagoTerapias = (array_sum($totalPagamentoTerapias));
				$recuperadoTerapias = (array_sum($totalRecuperadoTerapias));
				$eventoTerapias = (array_sum($totalEventoTerapias));
				$glosaTerapias = (array_sum($totalGlosaTerapias));

				$terapias = array(
					'tipo_evento'=>$tipoEvento,
					'total_evento'=>number_format($eventoTerapias, 2, ',', '.'),
					'total_recuperado'=>number_format($recuperadoTerapias, 2, ',', '.'),
					'total_pagamento'=>number_format($totalPagoTerapias, 2, ',', '.'),
					'total_glosas'=>number_format($glosaTerapias, 2, ',', '.')
				);				


				// Totalizadores Pacotes
				$selectEventosConhecidos = DB::connection('oracle_spasaude')
				->select("SELECT TIPO_EVENTO_ANS, VALOR_PAGAMENTO, VALOR_EVENTO, VALOR_RECUPERACAO, VLR_GLOSA FROM API_REG_AUX_EVENTOS_CONHECIDOS  WHERE TIPO_EVENTO_ANS = 'Pacotes' AND FK_REGISTROS_AUX_LOTE = $lote_fk");

				$tipoEvento = 'Pacotes';
				$totalPagamentoPacotes = array_column($selectEventosConhecidos, 'valor_pagamento');
				$totalRecuperadoPacotes = array_column($selectEventosConhecidos, 'valor_recuperacao');
				$totalEventoPacotes = array_column($selectEventosConhecidos, 'valor_evento');
				$totalGlosaPacotes = array_column($selectEventosConhecidos, 'vlr_glosa');

				$totalPagoPacotes = (array_sum($totalPagamentoPacotes));
				$recuperadoPacotes = (array_sum($totalRecuperadoPacotes));
				$eventoPacotes = (array_sum($totalEventoPacotes));
				$glosaPacotes = (array_sum($totalGlosaPacotes));

				$pacotes = array(
					'tipo_evento'=>$tipoEvento,
					'total_evento'=>number_format($eventoPacotes, 2, ',', '.'),
					'total_recuperado'=>number_format($recuperadoPacotes, 2, ',', '.'),
					'total_pagamento'=>number_format($totalPagoPacotes, 2, ',', '.'),
					'total_glosas'=>number_format($glosaPacotes, 2, ',', '.')
				);					


				// Totalizadores Consultas Médicas
				$selectEventosConhecidos = DB::connection('oracle_spasaude')
				->select("SELECT TIPO_EVENTO_ANS, VALOR_PAGAMENTO, VALOR_EVENTO, VALOR_RECUPERACAO, VLR_GLOSA FROM API_REG_AUX_EVENTOS_CONHECIDOS  WHERE TIPO_EVENTO_ANS = 'Consultas médicas' AND FK_REGISTROS_AUX_LOTE = $lote_fk");

				$tipoEvento = 'Consultas médicas';
				$totalPagamentoConsultasMedicas = array_column($selectEventosConhecidos, 'valor_pagamento');
				$totalRecuperadoConsultasMedicas = array_column($selectEventosConhecidos, 'valor_recuperacao');
				$totalEventoConsultasMedicas = array_column($selectEventosConhecidos, 'valor_evento');
				$totalGlosaConsultasMedicas = array_column($selectEventosConhecidos, 'vlr_glosa');

				$totalPagoConsultasMedicas = (array_sum($totalPagamentoConsultasMedicas));
				$recuperadoConsultasMedicas = (array_sum($totalRecuperadoConsultasMedicas));
				$eventoConsultasMedicas = (array_sum($totalEventoConsultasMedicas));
				$glosaConsultasMedicas = (array_sum($totalGlosaConsultasMedicas));
					
				$consultasMedicas = array(
					'tipo_evento'=>$tipoEvento,
					'total_evento'=>number_format($eventoConsultasMedicas, 2, ',', '.'),
					'total_recuperado'=>number_format($recuperadoConsultasMedicas, 2, ',', '.'),
					'total_pagamento'=>number_format($totalPagoConsultasMedicas, 2, ',', '.'),
					'total_glosas'=>number_format($glosaConsultasMedicas, 2, ',', '.')
				);



				// Totalizadores Exames Complementares
				$selectEventosConhecidos = DB::connection('oracle_spasaude')
				->select("SELECT TIPO_EVENTO_ANS, VALOR_PAGAMENTO, VALOR_EVENTO, VALOR_RECUPERACAO, VLR_GLOSA FROM API_REG_AUX_EVENTOS_CONHECIDOS  WHERE TIPO_EVENTO_ANS = 'Exames complementares' AND FK_REGISTROS_AUX_LOTE = $lote_fk");

				$tipoEvento = 'Exames complementares';
				$totalPagamentoExamesComplementares = array_column($selectEventosConhecidos, 'valor_pagamento');
				$totalRecuperadoExamesComplementares = array_column($selectEventosConhecidos, 'valor_recuperacao');
				$totalEventoExamesComplementares = array_column($selectEventosConhecidos, 'valor_evento');
				$totalGlosaExamesComplementares = array_column($selectEventosConhecidos, 'vlr_glosa');

				$totalPagoExamesComplementares = (array_sum($totalPagamentoExamesComplementares));
				$recuperadoExamesComplementares = (array_sum($totalRecuperadoExamesComplementares));
				$eventoExamesComplementares = (array_sum($totalEventoExamesComplementares));
				$glosaExamesComplementares = (array_sum($totalGlosaExamesComplementares));

				$examesComplementares = array(
					'tipo_evento'=>$tipoEvento,
					'total_evento'=>number_format($eventoExamesComplementares, 2, ',', '.'),
					'total_recuperado'=>number_format($recuperadoExamesComplementares, 2, ',', '.'),
					'total_pagamento'=>number_format($totalPagoExamesComplementares, 2, ',', '.'),
					'total_glosas'=>number_format($glosaExamesComplementares, 2, ',', '.')			
				);				


				// Totalizadores Atendimentos Abulatoriais
				$selectEventosConhecidos = DB::connection('oracle_spasaude')
				->select("SELECT TIPO_EVENTO_ANS, VALOR_PAGAMENTO, VALOR_EVENTO, VALOR_RECUPERACAO, VLR_GLOSA FROM API_REG_AUX_EVENTOS_CONHECIDOS  WHERE TIPO_EVENTO_ANS = 'Outros atendimentos ambulatoriais' AND FK_REGISTROS_AUX_LOTE = $lote_fk");

				$tipoEvento = 'Outros atendimentos ambulatoriais';
				$totalPagamentoOutrosAtendimentos = array_column($selectEventosConhecidos, 'valor_pagamento');
				$totalRecuperadoOutrosAtendimentos = array_column($selectEventosConhecidos, 'valor_recuperacao');
				$totalEventoOutrosAtendimentos = array_column($selectEventosConhecidos, 'valor_evento');
				$totalGlosaOutrosAtendimentos = array_column($selectEventosConhecidos, 'vlr_glosa');

				$totalPagoOutrosAtendimentos = (array_sum($totalPagamentoOutrosAtendimentos));
				$recuperadoOutrosAtendimentos = (array_sum($totalRecuperadoOutrosAtendimentos));
				$eventoOutrosAtendimentos = (array_sum($totalEventoOutrosAtendimentos));
				$glosaOutrosAtendimentos = (array_sum($totalGlosaOutrosAtendimentos));



					$atendimentosAmbulatoriais = array(
					'tipo_evento'=>$tipoEvento,
					'total_evento'=>number_format($eventoOutrosAtendimentos, 2, ',', '.'),
					'total_recuperado'=>number_format($recuperadoOutrosAtendimentos, 2, ',', '.'),
					'total_pagamento'=>number_format($totalPagoOutrosAtendimentos, 2, ',', '.'),
					'total_glosas'=>number_format($glosaOutrosAtendimentos, 2, ',', '.')
				);


				// Totalizadores Demais Despesas
				$selectEventosConhecidos = DB::connection('oracle_spasaude')
				->select("SELECT TIPO_EVENTO_ANS, VALOR_PAGAMENTO, VALOR_EVENTO, VALOR_RECUPERACAO, VLR_GLOSA FROM API_REG_AUX_EVENTOS_CONHECIDOS  WHERE TIPO_EVENTO_ANS = 'Demais despesas assistenciais' AND FK_REGISTROS_AUX_LOTE = $lote_fk");
				
				$tipoEvento = 'Demais despesas assistenciais';
				$totalPagamentoDemaisDespesas = array_column($selectEventosConhecidos, 'valor_pagamento');
				$totalRecuperadoDemaisDespesas = array_column($selectEventosConhecidos, 'valor_recuperacao');
				$totalEventoDemaisDespesas = array_column($selectEventosConhecidos, 'valor_evento');
				$totalGlosaDemaisDespesas = array_column($selectEventosConhecidos, 'vlr_glosa');

				$totalPagoDemaisdespesas = (array_sum($totalPagamentoDemaisDespesas));
				$recuperadoDemaisdespesas = (array_sum($totalRecuperadoDemaisDespesas));
				$eventoDemaisdespesas = (array_sum($totalEventoDemaisDespesas));
				$glosaDemaisdespesas = (array_sum($totalGlosaDemaisDespesas));

				$demaisDespesas = array(
					'tipo_evento'=>$tipoEvento, 
					'total_evento'=>number_format($eventoDemaisdespesas, 2, ',', '.'),
					'total_recuperado'=>number_format($recuperadoDemaisdespesas, 2, ',', '.'),
					'total_pagamento'=>number_format($totalPagoDemaisdespesas, 2, ',', '.'),
					'total_glosas'=>number_format($glosaDemaisdespesas, 2, ',', '.')
				);					


				// Monta Array com todos o Eventos
				$todosEventos = array(
					$internacoes,
					$terapias,
					$pacotes,
					$consultasMedicas,
					$examesComplementares,
					$atendimentosAmbulatoriais,
					$demaisDespesas
				);

				return response()->json($todosEventos);
	}


	//public function gerarExcelEventosPagosFilename(Request $request){		
	//	$filename = DB::connection('oracle_spasaude')
	//	->select("SELECT A.ID LOTE, B.DESCRICAO DESCRICAO, MES_REF MESREF 
	//	FROM REGISTROS_AUX_LOTE A
	//	INNER JOIN REGISTROS_AUX_OPERACOES B ON (A.FK_OPERACAO_REG_AUX = B.ID)
	//	INNER JOIN REGISTROS_AUX_LOTE_STATUS C ON(C.ID = A.FK_STATUS)
	//	WHERE A.ID = $request->lote_fk");

	//	return response()->json($filename);
	//}


	public function gerarExcelEventosConhecidos(Request $request){

		    $mesAno = '03-2022';
			$lote_fk = $request->FK_REGISTROS_AUX_LOTE;
			$logoSpa = 'S.P.A. SAUDE - SISTEMA DE PROMOCAO ASSISTENCIAL';
			$logoSpaEndereco = 'Rua Maestro Cardim, 1.191 - 8o andar - Paraiso - Sao Paulo/SP - CEP 01323-001';
			$LogoSpaTexto1 = 'REGISTRO AUXILIAR DE EVENTOS CONHECIDOS DE ASSISTENCIA A SAUDE';
			$LogoSpaTexto2 = 'Planos Coletivos por Adesao e Empresarial';
			$LogoSpaTexto3 = 'Cobertura Assistencial Medico Hospitalar Pre-estabelecido: Ambulatorial + Hospitalar com Obstetricia';
			$LogoSpaTexto4 = 'Mes Referencia:';

			$fileName = $lote_fk;

			$valorInternacoes = 0;

			$selectEventosConhecidos = DB::connection('oracle_spasaude')
            ->select("SELECT * FROM API_REG_AUX_EVENTOS_CONHECIDOS WHERE FK_REGISTROS_AUX_LOTE = $lote_fk");

			$countArray = count($selectEventosConhecidos)+9;

			$spreadsheet = new Spreadsheet(); 

			$spreadsheet->getActiveSheet()->getDefaultColumnDimension()->setWidth(120, 'pt');

    		$sheet = $spreadsheet->getActiveSheet(); 

			$sheet->getStyle("E".($countArray+3))->getFont()->setBold(true);


			//CABECALHO PLANILHA DADOS CORPORATIVOS 
			$sheet->setCellValue('A1', $logoSpa);
			$sheet->setCellValue('A2', $logoSpaEndereco);
			$sheet->setCellValue('A3', $LogoSpaTexto1);
			$sheet->setCellValue('A4', $LogoSpaTexto2);
			$sheet->setCellValue('A4', $LogoSpaTexto3);
			$sheet->setCellValue('A4', $LogoSpaTexto4);
			//FIM CABELHO PLANILHA DADOS CORPORATIVOS

			/*
				TOTALIZADOR EVENTOS PAGOS / GLOSAS
				A SOMA DE 9 AO COUNT DO ARRAY SE FAZ, POIS O CABECALHO TEM 9 LINHAS 
			*/
				
				$sheet->setCellValue("E".($countArray+3), 'TOTALIZADOR');
				$sheet->setCellValue("E".($countArray+4), '');
				$sheet->setCellValue("E".($countArray+5), 'TIPO EVENTO');
				$sheet->setCellValue("E".($countArray+6), '');
				$sheet->setCellValue("E".($countArray+7), 'Internacoes');
				$sheet->setCellValue("E".($countArray+8), 'Terapias');
				$sheet->setCellValue("E".($countArray+9), 'Pacotes');
				$sheet->setCellValue("E".($countArray+10), 'Consultas Medicas');
				$sheet->setCellValue("E".($countArray+11), 'Exames complementares');
				$sheet->setCellValue("E".($countArray+12), 'Outros atendimentos ambulatoriais');
				$sheet->setCellValue("E".($countArray+13), 'Demais despesas assistenciais');

				$sheet->setCellValue("F".($countArray+5), 'VALOR EVENTO');
				$sheet->setCellValue("F".($countArray+6), '');
				$sheet->setCellValue("F".($countArray+7), "$valorInternacoes");
				$sheet->setCellValue("F".($countArray+8), "$valorInternacoes");
				$sheet->setCellValue("F".($countArray+9), "$valorInternacoes");
				$sheet->setCellValue("F".($countArray+10), "$valorInternacoes");
				$sheet->setCellValue("F".($countArray+11), "$valorInternacoes");
				$sheet->setCellValue("F".($countArray+12), "$valorInternacoes");
				$sheet->setCellValue("F".($countArray+13), "$valorInternacoes");

				$sheet->setCellValue("G".($countArray+5), 'VALOR RECUPERADO');
				$sheet->setCellValue("G".($countArray+6), '');
				$sheet->setCellValue("G".($countArray+7), "$valorInternacoes");
				$sheet->setCellValue("G".($countArray+8), "$valorInternacoes");
				$sheet->setCellValue("G".($countArray+9), "$valorInternacoes");
				$sheet->setCellValue("G".($countArray+10), "$valorInternacoes");
				$sheet->setCellValue("G".($countArray+11), "$valorInternacoes");
				$sheet->setCellValue("G".($countArray+12), "$valorInternacoes");
				$sheet->setCellValue("G".($countArray+13), "$valorInternacoes");

				$sheet->setCellValue("H".($countArray+5), 'VALOR PAGAMENTO');
				$sheet->setCellValue("H".($countArray+6), '');
				$sheet->setCellValue("H".($countArray+7), "$valorInternacoes");
				$sheet->setCellValue("H".($countArray+8), "$valorInternacoes");
				$sheet->setCellValue("H".($countArray+9), "$valorInternacoes");
				$sheet->setCellValue("H".($countArray+10), "$valorInternacoes");
				$sheet->setCellValue("H".($countArray+11), "$valorInternacoes");
				$sheet->setCellValue("H".($countArray+12), "$valorInternacoes");
				$sheet->setCellValue("H".($countArray+13), "$valorInternacoes");


				$sheet->setCellValue("I".($countArray+5), 'VALOR GLOSA');
				$sheet->setCellValue("I".($countArray+6), '');
				$sheet->setCellValue("I".($countArray+7), "$valorInternacoes");
				$sheet->setCellValue("I".($countArray+8), "$valorInternacoes");
				$sheet->setCellValue("I".($countArray+9), "$valorInternacoes");
				$sheet->setCellValue("I".($countArray+10), "$valorInternacoes");
				$sheet->setCellValue("I".($countArray+11), "$valorInternacoes");
				$sheet->setCellValue("I".($countArray+12), "$valorInternacoes");
				$sheet->setCellValue("I".($countArray+13), "$valorInternacoes");
		
			//FIM TOTALIZADOR EVENTOS PAGOS / GLOSAS


			//MONTA CABEÇALHO BD PLANILHA		
			$sheet->setCellValue('A7', 'Numero do Evento');
			$sheet->setCellValue('B7', 'Codigo do Evento');
			$sheet->setCellValue('C7', 'Valor do Evento Avisado - R$');
			$sheet->setCellValue('D7', 'Valor do Evento Pago - R$');
			$sheet->setCellValue('E7', 'Valor da Recuperacao - R$');
			$sheet->setCellValue('F7', 'Valor da Glosa - R$');
			$sheet->setCellValue('G7', 'Data do Aviso do Evento');
			$sheet->setCellValue('H7', 'Data da Ocorrencia do Evento');
			$sheet->setCellValue('I7', 'Data do Pagamento do Evento');
			$sheet->setCellValue('J7', 'Identif. do benef. principal');
			$sheet->setCellValue('K7', 'CPF do beneficiario principal');
			$sheet->setCellValue('L7', 'Identif. do usuario do evento');
			$sheet->setCellValue('M7', 'CPF do usuario do evento');
			$sheet->setCellValue('N7', 'Numero do Contrato');
			$sheet->setCellValue('O7', 'Numero do Registro do Produto');
			$sheet->setCellValue('P7', 'Tipo de Produto');
			$sheet->setCellValue('Q7', 'CPF/CNPJ Prestador');
			$sheet->setCellValue('R7', 'Nome/Razao Social do Prestador');
			$sheet->setCellValue('S7', 'Tipo de Documento');
			$sheet->setCellValue('T7', 'Numero do Documento');
			$sheet->setCellValue('U7', 'Tipo de evento');
			$sheet->setCellValue('V7', 'Data de Apuracao da Glosa');
			//FIM CABEÇALHO
			
			//INSERT DADOS BD NO CORPO DA PLANILHA 

			$i=9;

			foreach ($selectEventosConhecidos as $evento):

				$sheet->setCellValue('A'.$i, number_format($evento->sequencial, 1, '-', ''));
				$sheet->setCellValue('B'.$i, $evento->num_evento);
				$sheet->setCellValue('C'.$i, number_format($evento->valor_evento, 2, ',', '.')); 
				$sheet->setCellValue('D'.$i, number_format($evento->valor_pagamento, 2, ',', '.')); 
				$sheet->setCellValue('E'.$i, number_format($evento->valor_recuperacao, 2, ',', '.')); 
				$sheet->setCellValue('F'.$i, number_format($evento->vlr_glosa, 2, ',', '.')); 
				$sheet->setCellValue('G'.$i, $evento->dt_conhecimento); 
				$sheet->setCellValue('H'.$i, $evento->dt_ocorrencia_evento); 
				$sheet->setCellValue('I'.$i, $evento->data_pagamento); 
				$sheet->setCellValue('J'.$i, $evento->nome_usuario_principal); 
				$sheet->setCellValue('K'.$i, $evento->cpf_cnpj_usuario_principal); 
				$sheet->setCellValue('L'.$i, $evento->nome_usuario_evento); 
				$sheet->setCellValue('M'.$i, $evento->cpf_benef_evento); 
				$sheet->setCellValue('N'.$i, $evento->contrato_benef); 
				$sheet->setCellValue('O'.$i, $evento->numero_registro_produto);
				$sheet->setCellValue('P'.$i, $evento->numero_registro_produto);
				$sheet->setCellValue('Q'.$i, $evento->cnpj_cpf_prestador);
				$sheet->setCellValue('R'.$i, $evento->nome_prestador);
				$sheet->setCellValue('S'.$i, $evento->tipo_documento);
				$sheet->setCellValue('T'.$i, $evento->documento);
				$sheet->setCellValue('U'.$i, $evento->tipo_evento_ans);
				$sheet->setCellValue('V'.$i, $evento->dt_conhecimento);

				$i++;

			endforeach;
			//FIM INSERT DADOS BD NO CORPO DA PLANILHA 

					$writer = new Xlsx($spreadsheet);

					$writerCsv = new Csv($spreadsheet);

					$writer->save($fileName.'.'.'xlsx');

					$writerCsv->save($fileName.'.'.'csv');

					ob_clean();
					ob_end_clean();

				return response()->download($fileName.'.'.'xlsx');

		}

		
				

}
