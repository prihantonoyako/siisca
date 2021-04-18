<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use App\Models\Pengguna\RoleModel;
use App\Models\Pengguna\AksesModel;
use App\Models\Pengguna\RolePenggunaModel;
use App\Models\Pengguna\PenggunaModel;
use App\Models\Pengguna\MenuModel;
use App\Models\Pengguna\MenuGroupModel;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(Request $request, $is_role_aktif=0,$menu_aktif=null){

        // if(($request->session()->has('role'))){
            // if($request->session()->get('role')!=$is_role_aktif){

            // }
        // }
        //find profile information
        $pengguna = PenggunaModel::find(Auth::guard('pengguna')->id())->first();

        //find role yang dijabat
        $roles = $this->getRolePengguna();

        //find informasi role yang aktif di dashboard
        if(!$is_role_aktif==0){
            $role_aktif = $this->getRole($is_role_aktif);
        }else{
            $role_aktif = $this->getRole($roles[$is_role_aktif]->id_role);
        }

        //find nama role yang dijabat
        // $role_pengguna = array();
        foreach($roles as $item) {
            $role_pengguna[$item->id_role] = $this->getRole($item->id_role);
            //->nama_role;
        }

        //find hak akses menu untuk role yang aktif
        if(!$is_role_aktif==0){
            $aksesMenu = $this->getAkses($is_role_aktif);
        }else{
            $aksesMenu = $this->getAkses($roles[$is_role_aktif]->id_role);
        }
        // $aksesMenu = $this->getAkses($roles[$is_role_aktif]->id_role);

        // $menus = array();
        $sumOfMenuGroup = MenuGroupModel::count();
        $groupMenuTitle = array();
        // $menu[id_group][id_menu] = nama_menu
        $counterGroup = 0;
        foreach($aksesMenu as $item) {
            if($counterGroup!=$sumOfMenuGroup){
                $tempTitle = MenuModel::find($item->id_menu)->belongsMenuGroup;
                // echo $tempTitle->nama_group . " ";
                // dd($tempTitle);
                // if(!Arr::exists($groupMenuTitle,$tempTitle->id_group)){
                //     $groupMenuTitle[$tempTitle->id_group] = $tempTitle->nama_group;
                //     $counterGroup++;
                // }
                // echo $tempTitle;
            }
        }
        // dd($role_pengguna);
        //menu[nama_menu] => id_group
        // dd($groupMenuTitle);
        //find menu yang boleh tampil
        // foreach($aksesMenu as $item){
        //     $menus[$item]
        // }
        // $menus = $this->getMenu($aksesMenu);
// dd($aksesMenu);

        // $menu_aktif = $this->getMenu($menu_aktif);

        //compiling profile information
        $profile = [
            'username' => $pengguna->username,
            'avatar' => $pengguna->foto
        ];
        session(['profile'=>$profile,
        'roles' => $role_pengguna,  
        'role_aktif' => $role_aktif->nama_role]);
        //show dashboard
        return view('portal.dashboard',[
            'profile'=>$profile,
            'roles' => $role_pengguna,
            'role_aktif' => $role_aktif->nama_role
        ]);
        // dd($aksesMenu);
        //dd($menus);
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
        $menus = MenuModel::find($id_menu)->get();
        return $menus;
    }

    //function for get akses to menu
    public function getAkses($role){
        $akses = RoleModel::find($role)
            ->hasAkses()
            ->where('is_aktif','1')
            ->get();
        return $akses;
    }

    //function for storing active role
    public function changeRole($role){
        session(['role'=>$role]);
    }
}