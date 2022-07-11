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

class Inputs extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable, HasFactory;
    /**
     * The connection database used by the model.
     *
     * @var string
     */
    protected $connection = 'oracle_spasaude';
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'REGISTROS_AUX_OPERACOES';
    
}
