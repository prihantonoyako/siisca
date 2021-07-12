<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Traits\MenuTrait;
use App\Http\Traits\PenggunaTrait;
use App\Http\Traits\UploadTrait;
use App\Models\Pengguna\MenuModel;
use App\Models\Pengguna\PenggunaModel;
use App\Models\Pengguna\RolePenggunaModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PenggunaController extends Controller
{
    use PenggunaTrait, MenuTrait, UploadTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response    
     */
    public function index()
    {
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

        $id_role = session('id_role');
        $isAdmin = $this->checkAdmin($id_role);
        if ($isAdmin) {
            $dataPenggunaAktif = PenggunaModel::all()->reject(function ($pengguna) {
                return $pengguna->is_aktif == 0;
            })->map(function ($pengguna) {
                $data = array(
                    $pengguna->id_pengguna,
                    $pengguna->username,
                    $pengguna->email
                );
                return $data;
            });
            $dataPenggunaInaktif = PenggunaModel::all()->reject(function ($pengguna) {
                return $pengguna->is_aktif == 1;
            })->map(function ($pengguna) {
                $data = array(
                    $pengguna->id_pengguna,
                    $pengguna->username,
                    $pengguna->email
                );
                return $data;
            });
            return view('admin.menu.account.profile', [
                'profile' => $profile,
                'rolesPengguna' => $rolesPengguna,
                'groupMenu' => $menus["GroupMenu"],
                'menu' => $menus["Menu"],
                'dataPenggunaAktif' => $dataPenggunaAktif,
                'dataPenggunaInaktif' => $dataPenggunaInaktif
            ]);
        } else {
            $url = 'account/profile/' . $id_pengguna;
            return redirect($url);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //Dashboard basic function
        $id_pengguna = session('id_pengguna');
        $this->setSessionMenu(null);
        $profile = $this->getPenggunaDashboard($id_pengguna);
        $rolesPengguna = $this->getRolesPengguna($id_pengguna);
        $aksesMenu = $this->getAkses(session('id_role'));
        $menus = $this->getMenus($aksesMenu);

        //find profile information
        $pengguna = PenggunaModel::find($id);
        $penggunaDetail['roles'] = $this->getRolesPengguna($id);

        $menuName = MenuModel::all('id_group', 'id_menu', 'nama_menu')->toArray();
        $permissionModules = $this->getPermissionModule($id);
        // dd($permissionModules);

        return view('menu.account.profile', [
            'profile' => $profile,
            'rolesPengguna' => $rolesPengguna,
            'groupMenu' => $menus["GroupMenu"],
            'menu' => $menus["Menu"],
            'pengguna' => $pengguna,
            'penggunaDetail' => $penggunaDetail,
            'menuName' => $menuName,
            'permissionModules' => $permissionModules
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //Dashboard basic function
        $id_pengguna = session('id_pengguna');
        $this->setSessionMenu(null);
        $profile = $this->getPenggunaDashboard($id_pengguna);
        $rolesPengguna = $this->getRolesPengguna($id_pengguna);
        $aksesMenu = $this->getAkses(session('id_role'));
        $menus = $this->getMenus($aksesMenu);

        $pengguna = PenggunaModel::find($id);
        // dd($pengguna);
        return view('menu.account.profile-edit', [
            'profile' => $profile,
            'rolesPengguna' => $rolesPengguna,
            'groupMenu' => $menus["GroupMenu"],
            'menu' => $menus["Menu"],
            'pengguna' => $pengguna,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $pengguna = PenggunaModel::find($id);
        $pengguna->nama_depan = request('nama_depan');
        $pengguna->nama_belakang = request('nama_belakang');
        $pengguna->email = request('email');
        $pengguna->save();
        return response()->json(['success' => 'success'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleteRole = RolePenggunaModel::where('id_pengguna', $id)->delete();
        if ($deleteRole) {
            PenggunaModel::destroy($id);
            return response()->json(['success' => 'success'], 200);
        }
        return response()->json(['errror' => 'error'], 500);
    }

    public function upload_avatar($pengguna)
    {
        //Dashboard basic function
        $id_pengguna = session('id_pengguna');
        $this->setSessionMenu(null);
        $profile = $this->getPenggunaDashboard($id_pengguna);
        $rolesPengguna = $this->getRolesPengguna($id_pengguna);
        $aksesMenu = $this->getAkses(session('id_role'));
        $menus = $this->getMenus($aksesMenu);

        return view('menu.account.profile-upload-foto', [
            'profile' => $profile,
            'rolesPengguna' => $rolesPengguna,
            'groupMenu' => $menus["GroupMenu"],
            'menu' => $menus["Menu"],
            'id_pengguna' => $pengguna
        ]);
    }

    public function upload_avatar_proses(Request $request)
    {
        $request->validate([
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $pengguna = PenggunaModel::find($request->id_pengguna);
        $fotoOrigin = $pengguna->foto;
        if (!is_null($fotoOrigin)) {
            $deletePath = '/public' . '/' . $fotoOrigin;
            if (Storage::disk('local')->exists($deletePath)) {
                $deleteFoto = Storage::disk('local')->delete($deletePath);
                if ($deleteFoto) {
                    $namaFoto = $pengguna->id_pengguna . "." . request()->foto->getClientOriginalExtension();
                    $pathDB = 'images/avatar' . '/' . $namaFoto;
                    $fotoSimpan = $request->file('foto')->storePubliclyAs('public/mencoba/avatar', $namaFoto, 'local');
                    if (!$fotoSimpan) {
                        return response()->json(['error' => 'error'], 500);
                    }
                    $pengguna->foto = $pathDB;
                    $pengguna->save();
                    return response()->json(['success' => 'success'], 200);
                }
                return response()->json(['error' => 'error'], 500);
            }
            return response()->json(['error' => 'error'], 500);
        }
        $namaFoto = $pengguna->id_pengguna . "." . request()->foto->getClientOriginalExtension();
        $pathDB = 'images/avatar' . '/' . $namaFoto;
        $request->file('foto')->storePubliclyAs('public/images/avatar', $namaFoto, 'local');
        $pengguna->foto = $pathDB;
        $pengguna->save();
        return response()->json(['success' => 'success'], 200);
    }
}
