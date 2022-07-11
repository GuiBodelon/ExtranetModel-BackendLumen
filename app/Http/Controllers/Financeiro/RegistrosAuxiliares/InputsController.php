<?php

namespace App\Http\Controllers\Financeiro\RegistrosAuxiliares;

use App\Models\Financeiro\RegistrosAuxiliares\Inputs;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;
use DB;

class InputsController extends BaseController
{   
    public function index(){
        $feedDropdown = Inputs::all();
        return response()->json($feedDropdown);
    }
}