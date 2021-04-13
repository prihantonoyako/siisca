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
    public function index($is_role_aktif=0){

        // if(($request->session()->has('role'))){
            
        // }
        //find profile information
        $pengguna = PenggunaModel::find(Auth::guard('pengguna')->id())->first();

        //find role yang dijabat
        $roles = $this->getRolePengguna();

        //find informasi role yang aktif di dashboard
        $role_aktif = $this->getRole($roles[$is_role_aktif]->id_role);

        $role_pengguna = array();
        //find nama role yang dijabat

        foreach($roles as $item){
            $role_pengguna[$item->id_role] = $this->getRole($item->id_role)->nama_role;
        }

        //compiling profile information
        $profile = [
            'username' => $pengguna->username,
            'avatar' => $pengguna->foto
        ];

        $test = $this->getAkses($roles[$is_role_aktif]->id_role);
        
        //show dashboard
        return view('portal.dashboard',[
            'profile'=>$profile,
            'roles' => $role_pengguna,
            'role_aktif' => $role_aktif->nama_role
        ]);
    }

    //function for finding role yang dijabat
    public function getRolePengguna(){
        $rolesPengguna = PenggunaModel::find(Auth::guard('pengguna')->id())->hasRole()->get();
        return $rolesPengguna;
    }

    //function for get role information
    public function getRole($id_role){
        $role = RoleModel::find($id_role);
        return $role;
    }

    //function for get menu
    public function getMenu($id_menu){
        $menus = RoleModel:: find($id_menu)->get();
    }

    //function for get akses to menu
    public function getAkses($role){
        $akses = RoleModel::find($role)
            ->hasAkses()
            ->where('is_aktif','1')
            ->pluck('id_menu');
        return $akses;
    }

    //function for storing active role
    public function changeRole($role){
        session(['role'=>$role]);
    } 
}
