<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Laravel\Lumen\Routing\Controller as BaseController;

class Teste extends BaseController
{
    function testeValores(){

        return $teste = 1000;


    }
}
