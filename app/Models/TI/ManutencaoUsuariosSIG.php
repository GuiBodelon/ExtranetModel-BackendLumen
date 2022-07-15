<?php

namespace App\Models\TI;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;
use DB;

class ManutencaoUsuariosSIG extends Model implements AuthenticatableContract, AuthorizableContract
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
    protected $table = 'SIGSPA00';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['spa00cod', 'spa00dig', 'spa00nom', 'spa00sen', 'spa00it1', 'spa00it2', 'spa00it3', 'spa00it4', 'spa00it5', 'spa00it6', 'spa00it7', 'spa00it8', 'spa00it9', 'spa00rec', 'spa00pro', 'spa00it10', 'spa00it11', 'spa00cla', 'spa00tra', 'spa00cpt', 'spa00sip', 'spa00con', 'spa00rh', 'spa00ans', 'spa00inf'];

    
    /**
     * Indicates if the model's ID is auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;
    public $timestamps = false;
    
}
