<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;
use DB;

class Governanca extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable, HasFactory;
    /**
     * The connection database used by the model.
     *
     * @var string
     */
    protected $connection = 'oracle_smartadm';
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'API_INDICADORES_RN443';
    
}
