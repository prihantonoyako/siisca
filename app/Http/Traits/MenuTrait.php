<?php

namespace App\Http\Traits;
use App\Models\Pengguna\RoleModel;
use App\Models\Pengguna\AksesModel;
use App\Models\Pengguna\RolePenggunaModel;
use App\Models\Pengguna\PenggunaModel;
use App\Models\Pengguna\MenuModel;
use App\Models\Pengguna\MenuGroupModel;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;


trait MenuTrait {

    //mendapatkan informasi menu
    public function getMenu($id_menu) {
        $menu = MenuModel::find($id_menu);
        return $menu;
    }

    public function getMenuGroup($id_group) {
        $groupMenu = MenuGroupModel::find($id_group);
        return $groupMenu;
    }

    //mengubah data session
    public function setSessionMenu($id_menu=null) {
        session([
            //menu aktif
            'id_menu'=>$id_menu
        ]);
    }

    public function getAkses($id_role) {
        $akses = RoleModel::find($id_role)
            ->hasAkses()
            ->where('is_aktif','1')
            ->get();
        return $akses;
    }

    public function getMenus($aksesMenu) {
        $sumOfMenuGroup = MenuGroupModel::count();
        $groupMenuTitle = array();
        $menuTitle = array();
        $counterGroup = 0;
        foreach($aksesMenu as $item) {
            $tempChildTitle = MenuModel::find($item->id_menu);
            if($counterGroup!=$sumOfMenuGroup){
                $tempTitle = MenuModel::find($item->id_menu)
                    ->belongsMenuGroup;
                if(!in_array($tempTitle,$groupMenuTitle)){
                    $groupMenuTitle[$tempTitle->id_group] = MenuModel::find($item->id_menu)
                        ->belongsMenuGroup;
                    $counterGroup++;
                }
            }
            $menuTitle[$tempChildTitle->id_menu] = $tempChildTitle;
        }
        $compiledData = array(
            "GroupMenu" => $groupMenuTitle,
            "Menu" => $menuTitle
        );
        return $compiledData;
    }
}