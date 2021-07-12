<?php

namespace App\Http\Controllers\Bmkg;
use App\Http\Controllers\Controller;
use App\Http\Traits\MenuTrait;
use App\Http\Traits\PenggunaTrait;
use App\Http\Traits\WeatherTrait;
use App\Models\Table\WilayahModel;
use Illuminate\Http\Request;

class StatistikController extends Controller
{
    use MenuTrait, PenggunaTrait, WeatherTrait;

    public function index()
    {
        
    }

    public function index_overview(){
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
        
        //show dashboard
        return view('menu.statistik.overview',[
            'profile' => $profile,
            'rolesPengguna' => $rolesPengguna,
            'groupMenu' => $menus["GroupMenu"],
            'menu' => $menus["Menu"],
            'provinsi' => $provinsi,
        ]);
    }

    public function show_overview(Request $request) {
        $area_id = $request->query('areaId');
        $fromDate = $request->query('fromDate');
        $toDate = $request->query('toDate');
        $statistik = $this->showStatistik($area_id,$fromDate,$toDate);
        if(!$statistik){
            $suggestion = "Minimum date: ".$this->check_datetime_suggestion();
            return response()->json($suggestion,500);
        }
        return response()->json($statistik, 200);
    }
}