<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use App\Http\Middleware\RoleAuth;
use App\Http\Traits\MenuTrait;
use App\Http\Traits\PenggunaTrait;
use App\Models\Pengguna\PenggunaModel;
use App\Models\Pengguna\MenuModel;
use App\Models\Pengguna\MenuGroupModel;
use App\Models\Table\WilayahModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    use MenuTrait, PenggunaTrait;

    public function index($id_role) {
        //get user id from session ref: LoginController
        $id_pengguna = session('id_pengguna');

        //set session user and menu
        $this->setSessionPengguna($id_role);
        $this->setSessionMenu(null);

        //find profile information
        $profile = $this->getPenggunaDashboard($id_pengguna);
    
        //find role yang dijabat
        $rolesPengguna = $this->getRolesPengguna($id_pengguna);

        //find hak akses menu untuk role yang aktif
        $aksesMenu = $this->getAkses($id_role);

        //find menu information
        $menus = $this->getMenus($aksesMenu);

        //show dashboard
        return view('portal.dashboard',[
            'profile' => $profile,
            'rolesPengguna' => $rolesPengguna,
            'groupMenu' => $menus["GroupMenu"],
            'menu' => $menus["Menu"]
        ]);

    }

    public function overview(Request $request){
        //get user id from session ref: LoginController
        $id_pengguna = session('id_pengguna');

        //set session user and menu
        $this->setSessionMenu(null);

        //find profile information
        $profile = $this->getPenggunaDashboard($id_pengguna);
    
        //find role yang dijabat
        $rolesPengguna = $this->getRolesPengguna($id_pengguna);

        //find hak akses menu untuk role yang aktif
        $aksesMenu = $this->getAkses(session('id_role'));

        //find menu information
        $menus = $this->getMenus($aksesMenu);

        //show dashboard

        return view('menu.statistik.overview',[
            'profile' => $profile,
            'rolesPengguna' => $rolesPengguna,
            'groupMenu' => $menus["GroupMenu"],
            'menu' => $menus["Menu"]
        ]);
    }

}