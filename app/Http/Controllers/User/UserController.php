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
        $profile = [
            'username' => $pengguna->username,
            'avatar' => $pengguna->foto
        ];
        $data = [
            'profile' => $profile
        ];
        return view('portal.dashboard',[
            'profile'=>$profile
        ]);
    }

    public function getRole(){
        $roles = PenggunaModel::find(Auth::guard('pengguna')->id())->hasRole()->get();
        // dd($role);
        foreach($roles as $role){
            echo $role->id_role;
        }
        // echo $role->id_role;
        // echo Auth::guard('pengguna')->id();
        //$role = RolePenggunaModel::where('id_pengguna',$id_pengguna)->get();
        // print_r($role);
    }

    public function getMenu(){
    }

    public function getAkses($role){
        $akses = RoleModel::find($role);
    }
}
