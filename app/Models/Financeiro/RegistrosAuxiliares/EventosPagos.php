<?php

namespace App\Models\Financeiro\RegistrosAuxiliares;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Http\Request;
use DB;

class EventosPagos extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable, HasFactory;
  

    protected $connection='oracle_spasaude';
    
 
    protected $table='API_REG_AUX_EVENTOS_PAGOS';
    
}