<?php

namespace App\Http\Controllers;

use App\Models\Beneficiario;
use Laravel\Lumen\Routing\Controller as BaseController;

class BeneficiarioController extends BaseController
{
    /**
     * Get Beneficario
     *
     * @return void
     */
    public function getBeneficiario()
    {
        return response()->json([
            "beneficiarios" => Beneficiario::where('NOME', 'LIKE', '%GUILHERME%')->get(['id','nome', 'matricula'])
        ]);
    }
}