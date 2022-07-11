<?php

namespace App\Http\Controllers;

use App\Models\User;
use Laravel\Lumen\Routing\Controller as BaseController;
use DB;
use App\Exports\UsersExport;
use Excel;

class UserController extends BaseController
{
    /**
     * Get user actual
     *
     * @return void
     */
    public function currentUser()
    {
        return response()->json(
            auth()->user()
        );
    }

    /**
     * Get list of users
     *
     * @return void
     */
    public function getUsers()
    {
        return response()->json([
            'usuarios' => User::all()
        ]);
    }
    /**
     * Load user Sidebar
     *
     * @return void
     */
    public function loadSidebar()
    {
        $menus = DB::connection('oracle_esaude_homolog')->select("SELECT A.*, LEVEL FROM API_MENUS A WHERE STATUS = '1' START WITH PARENT_ID = 0 CONNECT BY PRIOR ID = PARENT_ID");
        $menuArray = [];
        foreach($menus as $menu){

            $menuID = $menu->id;
            $menuTitle = $menu->title;
            $menuHref = $menu->href;
            $menuIcon = $menu->icon;
            $menuParent = $menu->parent_id;

            $menuArray[] = array(
                "id" => $menuID,
                "title" => $menuTitle,
                "href" => $menuHref,
                "icon" => $menuIcon,
                "parent_id" => $menuParent
            );

        }
        $tree = buildTree($menuArray, 'parent_id', 'id');
        return $tree;
    }       
        
    public function loadSidebar2(){
        $menus = DB::connection('oracle_esaude_homolog')->select("SELECT * FROM API_MENUS_LEVEL1");
            $childArray = [];
            $headerArray = ["header" => 'Main Navigation', "hiddenOnCollapse" => 'true'];

            foreach ($menus as $menu){
                $menuID = $menu->id;
                $menuTitle = $menu->title;
                $menuHref = $menu->href;
                $menuIcon = $menu->icon;    
                
                $firstChildren = DB::connection('oracle_esaude_homolog')->select("SELECT * FROM API_SUBMENUS_LEVEL2 WHERE FK_MENU_LEVEL1 = '$menuID'");                
                
                foreach ($firstChildren as $child){
                    $childID = $child->id;
                    $childTitle = $child->title;
                    $childHref = $child->href;
                    $childIcon = $child->icon;
                    $secondChildren = DB::connection('oracle_esaude_homolog')->select("SELECT * FROM API_SUBMENUS_LEVEL3 WHERE FK_SUBMENU_LEVEL2 = '$childID'");

                    $childArray[] = array(
                        "id" => $childID,
                        "title" => $childTitle,
                        "href" => $childHref,
                        "icon" => $childIcon,
                        "child" => $secondChildren
                    );
                }
                
                $menuArray[] = array(
                    "id" => $menuID,
                    "title" => $menuTitle,
                    "href" => $menuHref,
                    "icon" => $menuIcon,
                    "child" => $childArray
                );

                $childArray = []; //Esvaziar Array

            }

            //array_unshift($menuArray, $headerArray);

            return response()->json($menuArray);
    }
    public function export() 
    {
        ob_end_clean(); // this
        ob_start(); // and this
        return Excel::download(new UsersExport, 'EVENTOS_PAGOS_TESTE.xlsx');
    }
}