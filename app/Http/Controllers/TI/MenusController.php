<?php

namespace App\Http\Controllers\TI;

use App\Models\TI\ManutencaoMenus;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;
use DB;
use Illuminate\Support\Facades\Schema;

class MenusController extends BaseController
{
    /**
     * Get Menus
     *
     * @return void
     */

     public function getMenus(Request $request)
     {
        $menus = ManutencaoMenus::orderBy('id', 'asc')->get();
        return response()->json($menus);
     }

     public function atualizarMenu(Request $request){
        $id = $request->id;
        $title = $request->title;
        $href = $request->href;
        $icon = $request->icon;
        $parent_id = $request->parent_id;

        $atualizarMenu = ManutencaoMenus::where('ID', $id)
        ->update([
            'TITLE' => $title,
            'HREF' => $href,
            'ICON' => $icon,
            'PARENT_ID' => $parent_id
        ]);
     }

     public function criarMenu(Request $request){
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
     public function mudarStatusMenu(Request $request){
        $id = $request->id;
        $status = $request->status;

        $atualizarMenu = ManutencaoMenus::where('ID', $id)
        ->update(['STATUS' => $status]);
     }
     public function getParentMenus(){
         $parentMenus = ManutencaoMenus::orderBy('id', 'asc')
         ->where('PARENT_ID', '0')
         ->where('STATUS', '1')
         ->get();
         return response()->json($parentMenus);
     }
     public function criarMenuChild(Request $request){
      $next_id = DB::select("SELECT MAX(ID) + 1 ID FROM API_MENUS");
      $sysdate = DB::select("SELECT SYSDATE FROM DUAL");
      //print_r();
      $data = array(         
          'id' => $next_id[0]->id,
          'title' => $request->title,
          'href' => $request->href,
          'icon' => 'fa-solid fa-caret-right',
          'parent_id' => $request->parent,
          'created_at' => $sysdate[0]->sysdate
      );
      DB::table('API_MENUS')->insert($data);
   }
}