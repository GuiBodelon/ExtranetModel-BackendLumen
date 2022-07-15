<?php

namespace App\Http\Controllers\TI;

use App\Models\TI\ManutencaoUsuariosSIG;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;
use DB;
use Illuminate\Support\Facades\Schema;

class UsuariosSigController extends BaseController
{
    /**
     * Get Usuarios
     *
     * @return void
     */

     public function getUsuarios(Request $request)
     {
        $usuarios = ManutencaoUsuariosSIG::orderBy('spa00nom', 'asc')->get();
        return response()->json($usuarios);
     }

     public function getUsuario(Request $request)
     {
        $usuario = ManutencaoUsuariosSIG::where('spa00cod', $request->id)->get();
        return response()->json($usuario);
     }

     public function atualizarUsuario(Request $request){
        $spa00cod = $request->spa00cod;
        $spa00dig = $request->spa00dig;
        $spa00nom = $request->spa00nom;
        $spa00sen = $request->spa00sen;
        $spa00it1 = $request->spa00it1;
        $spa00it2 = $request->spa00it2;
        $spa00it3 = $request->spa00it3;
        $spa00it4 = $request->spa00it4;
        $spa00it5 = $request->spa00it5;
        $spa00it6 = $request->spa00it6;
        $spa00it7 = $request->spa00it7;
        $spa00it8 = $request->spa00it8;
        $spa00it9 = $request->spa00it9;
        $spa00rec = $request->spa00rec;
        $spa00pro = $request->spa00pro;
        $spa00it10 = $request->spa00it10;
        $spa00it11 = $request->spa00it11;
        $spa00cla = $request->spa00cla;
        $spa00tra = $request->spa00tra;
        $spa00cpt = $request->spa00cpt;
        $spa00sip = $request->spa00sip;
        $spa00con = $request->spa00con;
        $spa00rh = $request->spa00rh;
        $spa00ans = $request->spa00ans;
        $spa00inf = $request->spa00inf;

         $atualizarUsuario = ManutencaoUsuariosSIG::where('spa00cod', $spa00cod)
         ->update([
                'spa00dig' => $spa00dig,
                'spa00nom' => $spa00nom,
                'spa00sen' => $spa00sen,
                'spa00it1' => $spa00it1,
                'spa00it2' => $spa00it2,
                'spa00it3' => $spa00it3,
                'spa00it4' => $spa00it4,
                'spa00it5' => $spa00it5,
                'spa00it6' => $spa00it6,
                'spa00it7' => $spa00it7,
                'spa00it8' => $spa00it8,
                'spa00it9' => $spa00it9,
                'spa00rec' => $spa00rec,
                'spa00pro' => $spa00pro,
                'spa00it10' => $spa00it10,
                'spa00it11' => $spa00it11,
                'spa00cla' => $spa00cla,
                'spa00tra' => $spa00tra,
                'spa00cpt' => $spa00cpt,
                'spa00sip' => $spa00sip,
                'spa00con' => $spa00con,
                'spa00rh' => $spa00rh,
                'spa00ans' => $spa00ans,
                'spa00inf' => $spa00inf
         ]);
     }

     public function criarUsuario(Request $request){
        $next_id = DB::select("SELECT MAX(ID) + 1 ID FROM API_MENUS");
        $sysdate = DB::select("SELECT SYSDATE FROM DUAL");
        //print_r();
        $data = array(
            'id' => $next_id[0]->id,
            'title' => $request->title,
            'href' => $request->href,
            'icon' => $request->icon,
            'parent_id' => 0,
            'created_at' => $sysdate[0]->sysdate
        );
        DB::table('API_MENUS')->insert($data);
     }
}