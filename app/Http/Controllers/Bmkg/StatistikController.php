<?php

namespace App\Http\Controllers\Bmkg;
use App\Http\Controllers\Controller;
use App\Http\Middleware\RoleAuth;
use App\Http\Traits\MenuTrait;
use App\Http\Traits\PenggunaTrait;
use App\Http\Traits\WeatherTrait;
use App\Models\Pengguna\PenggunaModel;
use App\Models\Pengguna\MenuModel;
use App\Models\Pengguna\MenuGroupModel;
use App\Models\Table\WilayahModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StatistikController extends Controller
{
    use MenuTrait, PenggunaTrait, WeatherTrait;

    public function index()
    {
        
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

        //get area to display
        $provinsi = WilayahModel::pluck('provinsi','area_id')->all();

        $area_id = $request->provinsi;
        $fromDate = $request->from;
        $toDate = $request->to;

        $statistik = $this->showStatistik($area_id,$fromDate,$toDate);

        //show dashboard
        return view('menu.statistik.overview',[
            'profile' => $profile,
            'rolesPengguna' => $rolesPengguna,
            'groupMenu' => $menus["GroupMenu"],
            'menu' => $menus["Menu"],
            'provinsi' => $provinsi,
            'statistik' => $statistik
        ]);
    }
}