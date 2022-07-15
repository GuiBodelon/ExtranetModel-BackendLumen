<?php

namespace App\Http\Controllers;

use App\Models\EventosPagos;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;
use DB;

class EventosPagosController extends BaseController
{

    /*  Funcoes  */
   
    public function index(Request $request){


            $selectApiRegEventosPagos = EventosPagos::all();
        
            return $selectApiRegEventosPagos;

    }


    public function store(Request $request){

        return 'Inserindo api_reg_eventos_pagos';

    }


    /*  Fim Funcoes*/

        /* =================================================================================== */
}