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


trait MenuTrait
{

    //mendapatkan informasi menu
    public function getMenu($id_menu)
    {
        $menu = MenuModel::find($id_menu);
        return $menu;
    }

    protected function getMenuGroup($id_group)
    {
        $groupMenu = MenuGroupModel::find($id_group);
        return $groupMenu;
    }

    //mengubah data session
    public function setSessionMenu($id_menu = null)
    {
        session([
            //menu aktif
            'id_menu' => $id_menu
        ]);
    }

    public function getAkses($id_role)
    {
        $akses = RoleModel::find($id_role)
            ->hasAkses()
            ->where('is_aktif', '1')
            ->get();
        return $akses;
    }

    public function getMenus($aksesMenu)
    {
        $sumOfMenuGroup = MenuGroupModel::count();
        $groupMenu = array();
        $groupId = array();
        $menuId = array();
        $menu = array();
        $counterGroup = 0;
        foreach ($aksesMenu as $item) {
            if ($counterGroup != $sumOfMenuGroup) {
                $tempGroup = MenuModel::find($item->id_menu)->belongsMenuGroup;
                if (!in_array($tempGroup->id_group, $groupId)) {
                    array_push($groupId, $tempGroup->id_group);
                    $menu[$tempGroup->id_group] = array();
                    $counterGroup++;
                }
            }
            array_push($menuId, $item->id_menu);
        }
        $tempGroup = MenuGroupModel::whereIn('id_group', $groupId)->where('is_aktif', '1')->orderBy('urutan', 'asc')->get();
        $groupMenu = $tempGroup;
        $tempMenu = MenuModel::whereIn('id_menu', $menuId)->where('is_aktif', '1')->orderBy('urutan', 'asc')->get();
        foreach ($tempMenu as $item) {
            $menu[$item->id_group][$item->id_menu] = $item;
        }
        $compiledData = array(
            "GroupMenu" => $groupMenu,
            "Menu" => $menu
        );
        return $compiledData;
    }
}
