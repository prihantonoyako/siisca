<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use App\Models\Pengguna\RoleModel;
use App\Models\Pengguna\AksesModel;
use App\Models\Pengguna\RolePenggunaModel;
use App\Models\Pengguna\PenggunaModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(){
        $pengguna = PenggunaModel::find(Auth::guard('pengguna')->id())->first();
        $role = $this->getRole();
        $role_aktif = RoleModel::find($role);
        $nama_role = array();
        foreach($role_aktif as $item){
            array_push($nama_role,$item->nama_role);
        }
        $profile = [
            'username' => $pengguna->username,
            'avatar' => $pengguna->foto
        ];
        $data = [
            'profile' => $profile,
            'role_aktif' => $nama_role
        ];
        // dd($role_aktif[0]->id_role);
        $this->getAkses($role_aktif[0]->id_role);
        // return view('portal.dashboard',[
        //     'profile'=>$profile,
        //     'role_aktif' => $nama_role
        // ]);
    }

    public function getRole(){
        $roles = PenggunaModel::find(Auth::guard('pengguna')->id())->hasRole()->get();
        $role = array();
        foreach($roles as $item){
            array_push($role,$item->id_role);
        }
        return $role;
    }

    public function getMenu($id_menu){
        $menus = RoleModel:: find($id_menu);
    }

    public function getAkses($role){
        $akses = RoleModel::find($role)
            ->hasAkses()
            ->where('is_aktif','1')
            ->pluck('id_menu');
        return $akses;
    }
}
