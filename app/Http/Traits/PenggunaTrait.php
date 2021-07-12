<?php

namespace App\Http\Traits;

use App\Models\Pengguna\AksesModel;
use App\Models\Pengguna\MenuModel;
use App\Models\Pengguna\PenggunaModel;
use App\Models\Pengguna\RoleModel;

trait PenggunaTrait
{

    public function setSessionPengguna($id_role)
    {
        session([
            //role aktif
            'id_role' => $id_role,
            //active role name
            'role_name' => RoleModel::find($id_role)->nama_role
        ]);
    }

    //Mendapatkan informasi pengguna
    public function getPenggunaDashboard($id_pengguna)
    {
        $pengguna = PenggunaModel::find($id_pengguna);
        $penggunaDashboard = array(
            "nama" => $pengguna->getNamaPenggunaAttribute(),
            "foto" => $pengguna->foto
        );
        return $penggunaDashboard;
    }

    //mencari role yang dijabat
    public function getRolesPengguna($id_pengguna)
    {
        $rolesPengguna = PenggunaModel::find($id_pengguna)->hasRole()->get();
        $role_pengguna = array();
        foreach ($rolesPengguna as $item) {
            $role = RoleModel::find($item->id_role);
            array_push($role_pengguna, array(
                "id_role" => $role->id_role,
                "nama_role" => $role->nama_role,
                "url" => $role->url
            ));
        }
        return $role_pengguna;
    }

    public function getPermissionModule($id_pengguna)
    {
        $rolesPengguna = PenggunaModel::find($id_pengguna)->hasRole()->get();
        $role_pengguna = array();
        $menufromDB = MenuModel::pluck('id_menu');
        foreach ($rolesPengguna as $item) {
            $role = RoleModel::find($item->id_role);
            $menuPermission = array();
            foreach($menufromDB as $menuItem){
                $aksesMenu = AksesModel::where('id_role', $role->id_role)->where('id_menu',$menuItem)->where('is_aktif', '1')->exists();
                if($aksesMenu){
                    array_push($menuPermission,array(
                        $menuItem => true
                    ));
                }else{
                    array_push($menuPermission,array(
                        $menuItem => false
                    ));
                }
            }
            $role_pengguna[$item->id_role] = $menuPermission;
        }
        return $role_pengguna;
    }

    public function getFotoPengguna($id_pengguna)
    {
        $pengguna = PenggunaModel::find($id_pengguna);
        return $pengguna->foto;
    }

    public function getNamaPengguna($id_pengguna)
    {
        $pengguna = PenggunaModel::find($id_pengguna);
        return $pengguna->getNamaPenggunaAttribute();
    }

    public function checkAdmin($id_role)
    {
        $roleAdmin = RoleModel::find($id_role)->nama_role;
        $adminRole = "developer";
        $isAdmin = strcasecmp($adminRole, $roleAdmin);
        if ($isAdmin === 0) {
            return true;
        }
        return false;
    }
}
