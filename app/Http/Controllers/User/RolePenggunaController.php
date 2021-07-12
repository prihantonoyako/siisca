<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use App\Http\Traits\MenuTrait;
use App\Http\Traits\PenggunaTrait;
use App\Models\Pengguna\MenuModel;
use App\Models\Pengguna\MenuGroupModel;
use App\Models\Pengguna\RolePenggunaModel;
use Illuminate\Http\Request;


class MenuController extends Controller
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

        $rolePenggunaDB = RolePenggunaModel::all();
        return view('menu.setting.role-pengguna', [
            'profile' => $profile,
            'rolesPengguna' => $rolesPengguna,
            'groupMenu' => $menus["GroupMenu"],
            'menu' => $menus["Menu"],
            'rolePenggunaDB' => $rolePenggunaDB
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

        $groupDB = MenuGroupModel::where('is_aktif', '1')->get(['id_group', 'nama_group'])->toArray();

        return view('menu.setting.menu-create', [
            'profile' => $profile,
            'rolesPengguna' => $rolesPengguna,
            'groupMenu' => $menus["GroupMenu"],
            'menu' => $menus["Menu"],
            'groupDB' => $groupDB
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
        $request->validate([
            'nama_menu' => ['alpha', 'max:255'],
            'url_menu' => ['alpha_dash', 'max:255'],
            'icon' => ['alpha_dash'],
            'urutan' => ['integer'],
        ]);

        if ($request->has('is_aktif')) {
            $is_aktif = '1';
        }else{
            $is_aktif = '0';
        }

        if(MenuModel::where('id_group', $request->input('id_group'))
        ->where('urutan',$request->input('urutan'))
        ->exists()) {
                return redirect()->back()->with('urutan_conflict', true);
        }
     
        $menuDB = new MenuModel;       
        $menuDB->id_group = $request->input('id_group');
        $menuDB->urutan = $request->input('urutan');
        $menuDB->nama_menu = $request->input('nama_menu');
        $menuDB->url_menu = $request->input('url_menu');
        $menuDB->icon = $request->input('icon');
        $menuDB->is_aktif = $is_aktif;

        $menuDB->save();

        return redirect('setting/menu')->with('success', true);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

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
        $request->validate([
            'nama_menu' => ['nullable', 'alpha', 'max:255'],
            'url_menu' => ['nullable', 'alpha_dash', 'max:255'],
            'icon' => ['nullable','alpha_dash'],
            'urutan' => ['nullable', 'integer'],
        ]);

        if ($request->has('is_aktif')) {
            $is_aktif = '1';
        }else{
            $is_aktif = '0';
        }

        if(MenuModel::where('id_group', $request->input('id_group'))
        ->where('urutan',$request->input('urutan'))
        ->exists()) {
                return redirect()->back()->with('urutan_conflict', true);
        }

        $menuDB = MenuModel::find($id);
        switch(true){
            case $request->filled('nama_menu'):
                    $menuDB->nama_menu = $request->input('nama_menu');
            case $request->filled('url_menu'):
                    $menuDB->url_menu = $request->input('url_menu');
                    case $request->filled('icon'):
                        $menuDB->urutan = $request->input('icon');
            case $request->filled('urutan'):
                    $menuDB->urutan = $request->input('urutan');
        }
        $menuDB->id_group = $request->input('id_group');
        $menuDB->is_aktif = $is_aktif;
        $menuDB->save();
        return redirect()->back()->with('success', true);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
    }
}
