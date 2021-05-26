<?php

namespace App\Http\Traits;
use App\Models\Pengguna\PenggunaModel;
use App\Models\Pengguna\RoleModel;

Trait PenggunaTrait {

    public function setSessionPengguna($id_role) {
        session([
            //role aktif
            'id_role' => $id_role,
            //active role name
            'role_name' => RoleModel::find($id_role)->nama_role
        ]);
    }

    //Mendapatkan informasi pengguna
    public function getPenggunaDashboard($id_pengguna){
        $pengguna = PenggunaModel::find($id_pengguna);
        $penggunaDashboard = array(
            "nama" => $pengguna->getNamaPenggunaAttribute(),
            "foto" => $pengguna->foto
        );
        return $penggunaDashboard;
    }

    //mencari role yang dijabat
    public function getRolesPengguna($id_pengguna) {
        $rolesPengguna = PenggunaModel::find($id_pengguna)->hasRole()->get();
        $role_pengguna = array();
        foreach($rolesPengguna as $item){
            $role = RoleModel::find($item->id_role);
            array_push($role_pengguna,array(
                "id_role" => $role->id_role,
                "nama_role" => $role->nama_role,
                "url" => $role->url
            ));
        }
        return $role_pengguna;
    }

    public function getFotoPengguna($id_pengguna){
        $pengguna = PenggunaModel::find($id_pengguna);
        return $pengguna->foto;
    }

    public function getNamaPengguna($id_pengguna){
        $pengguna = PenggunaModel::find($id_pengguna);
        return $pengguna->getNamaPenggunaAttribute();
    }
}