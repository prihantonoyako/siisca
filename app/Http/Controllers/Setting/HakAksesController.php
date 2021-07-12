<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use App\Http\Traits\MenuTrait;
use App\Http\Traits\PenggunaTrait;
use App\Models\Pengguna\MenuModel;
use App\Models\Pengguna\MenuGroupModel;
use App\Models\Pengguna\AksesModel;
use App\Models\Pengguna\RoleModel;
use Illuminate\Http\Request;


class HakAksesController extends Controller
{
    use MenuTrait, PenggunaTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id_pengguna = session('id_pengguna');
        $this->setSessionMenu(null);
        $profile = $this->getPenggunaDashboard($id_pengguna);
        $rolesPengguna = $this->getRolesPengguna($id_pengguna);
        $aksesMenu = $this->getAkses(session('id_role'));
        $menus = $this->getMenus($aksesMenu);

        $aksesDB = AksesModel::all();
        return view('menu.setting.hak-akses', [
            'profile' => $profile,
            'rolesPengguna' => $rolesPengguna,
            'groupMenu' => $menus["GroupMenu"],
            'menu' => $menus["Menu"],
            'aksesDB' => $aksesDB
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $id_pengguna = session('id_pengguna');
        $this->setSessionMenu(null);
        $profile = $this->getPenggunaDashboard($id_pengguna);
        $rolesPengguna = $this->getRolesPengguna($id_pengguna);
        $aksesMenu = $this->getAkses(session('id_role'));
        $menus = $this->getMenus($aksesMenu);

        $roleDB = RoleModel::where('is_aktif', '1')->get(['id_role', 'nama_role'])->toArray();
        $menuDB = MenuModel::all();
        return view('menu.setting.hak-akses-create', [
            'profile' => $profile,
            'rolesPengguna' => $rolesPengguna,
            'groupMenu' => $menus["GroupMenu"],
            'menu' => $menus["Menu"],
            'roleDB' => $roleDB,
            'menuDB' => $menuDB
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->has('is_aktif')) {
            $is_aktif = '1';
        }else{
            $is_aktif = '0';
        }
     
        $akses = new AksesModel;
        $akses->id_role = $request->input('id_role');
        $akses->id_menu = $request->input('id_menu');
        $akses->is_aktif = $is_aktif;

        $akses->save();

        return redirect('setting/hak_akses')->with('success', true);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $aksesDB = AksesModel::where('id_role',$id)->pluck('id_menu');
        $menuDB = MenuModel::whereNotIn('id_menu',$aksesDB)->get();
        $result= array();
        foreach($menuDB as $item){
            $temp = array(
                'id_group' => $item->id_group,
                'nama_group' => $item->belongsMenuGroup->nama_group,
                'id_menu' => $item->id_menu,
                'nama_menu' => $item->nama_menu
            );
            array_push($result,$temp);
        }
        return response()->json($result,200);
    }

    public function edit($id)
    {
        $id_pengguna = session('id_pengguna');
        $this->setSessionMenu(null);
        $profile = $this->getPenggunaDashboard($id_pengguna);
        $rolesPengguna = $this->getRolesPengguna($id_pengguna);
        $aksesMenu = $this->getAkses(session('id_role'));
        $menus = $this->getMenus($aksesMenu);

        $menuDB = MenuModel::find($id);
        $menuGroupDB = MenuGroupModel::where('id_group', '!=', $menuDB->belongsMenuGroup->id_group)
            ->where('is_aktif', '1')->get(['id_group', 'nama_group'])->toArray();
        $urutanSuggestion = MenuModel::where('id_menu', '!=', $id)->where('id_group', $menuDB->id_group)->pluck('urutan');

        return view('menu.setting.menu-edit', [
            'profile' => $profile,
            'rolesPengguna' => $rolesPengguna,
            'groupMenu' => $menus["GroupMenu"],
            'menu' => $menus["Menu"],
            'groupDB' => $menuGroupDB,
            'menuDB' => $menuDB,
            'urutanSuggestion' => $urutanSuggestion
        ]);
    }

    public function update(Request $request, $id)
    {
        if ($request->ajax()) {
            $is_aktif = '0';
            if(request('is_aktif')=="true"){
                $is_aktif = '1';
            }
            $menuDB = AksesModel::find($id);
            $menuDB->is_aktif = $is_aktif;
            $menuDB->save();
            return response()->json(['success' => 'Akses is updated'],200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $akses = AksesModel::find($id);
        $is_deleted = $akses->delete();
        if($is_deleted){
            return response()->json(['success' => 'success'], 200);
        }
        return response()->json(['error' => 'error'], 500);
    }
}