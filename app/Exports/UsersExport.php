<?php

namespace App\Exports;

use App\Models\Financeiro\RegistrosAuxiliares\EventosPagos;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithMapping;

use DB;

class UsersExport implements FromQuery, WithHeadings
{
    use Exportable;

    public function query()
    {
        //return DB::table('API_REG_AUX_EVENTOS_PAGOS')->orderBy('SEQUENCIAL', 'asc');
        return DB::table('API_REG_AUX_EVENTOS_PAGOS')->orderBy('SEQUENCIAL', 'asc');
    }

    public function headings(): array
    {
        return [
            'SEQUENCIAL',
            'NUM_EVENTO',
            'NUM_CONTRATO',
            'NATUREZA',
            'COBERTURA',
            'DT_CONHECIMENTO',
            'NOME_USUARIO_PRINCIPAL',
            'CPF_CNPJ_USUARIO_PRINCIPAL',
            'NOME_USUARIO_EVENTO',
            'DT_OCORRENCIA_EVENTO',
            'VENCIMENTO_CONTRATO',
            'VALOR_EVENTO',
            'OPERADOR',
            'MESANO',
            'TIPO_EVENTO',
            'CREDENCIADO',
            'ASSOCIADA',
            'DOCUMENTO',
            'TABELA',
            'COD_SEQ_TABELA',
            'GUIA_TERMINOLOGIA_FK',
            'TIPO_DOCUMENTO',
            'DATA_PAGAMENTO',
            'VALOR_PAGAMENTO',
            'TIPO_EVENTO_ANS',
            'NUMERO_REGISTRO_PRODUTO',
            'CONTRATO_BENEF',
            'VALOR_RECUPERACAO',
            'VLR_GLOSA',
            'CNPJ_CPF_PRESTADOR',
            'NOME_PRESTADOR',
            'CODIGO_BENEF_EVENTO',
            'CPF_BENEF_EVENTO',
            'TIPO_MODALIDADE', 
            'LOTE_FK'
        ];
    }
}