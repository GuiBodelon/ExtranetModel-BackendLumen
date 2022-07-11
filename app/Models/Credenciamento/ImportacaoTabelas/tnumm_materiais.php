<?php

namespace App\Models\Credenciamento\ImportacaoTabelas;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;
use DB;

class tnumm_materiais extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable, HasFactory;
    /**
     * The connection database used by the model.
     *
     * @var string
     */
    protected $connection = 'oracle_esaude_homolog';
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'API_TNUMM_MATERIAIS';
    
}