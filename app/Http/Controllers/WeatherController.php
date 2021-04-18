<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Table\KelembapanModel;
use App\Models\Table\SuhuModel;
use App\Models\Table\WilayahModel;

class WeatherController extends Controller
{
    public function kelembapan(){
        $kelembapan = new KelembapanModel();            
        $fillable = $kelembapan->getFillable();
        $profile = session('profile');
        $role_pengguna = session('roles');
        $role_aktif = session('role_aktif');
        $is_area = array();
        $area = WilayahModel::all();
        foreach($area as $item){
            $is_area[$item->area_id] = $item->provinsi;
        }
        $data = KelembapanModel::simplePaginate(15);
        // dd($fillable);
        // dd($area);
        return view('portal.menu',[
            'profile'=>$profile,
            'roles' => $role_pengguna,
            'role_aktif' => $role_aktif,
            'data' => $data,
            'fields' => $fillable,
            'areas' => $is_area
        ]);
    }

    public function suhu(){
        $suhu = new SuhuModel();
        $fillable = $suhu->getFillable();
        $profile = session('profile');
        $role_pengguna = session('roles');
        $role_aktif = session('role_aktif');
        $data = SuhuModel::simplePaginate(15);
        $area = WilayahModel::all();
        foreach($area as $item){
            $is_area[$item->area_id] = $item->provinsi;
        }
        // dd($fillable);
        return view('portal.menu',[
            'profile'=>$profile,
            'roles' => $role_pengguna,
            'role_aktif' => $role_aktif,
            'data' => $data,
            'fields' => $fillable,
            'areas' => $is_area
        ]);
    }

    
    // <th scope="row">{{ $item->area_id }}</th>
    // <td>{{ $item->kelembapan }}</td>
    // <td>{{ $item->timerange }}</td>

    // public function kelembapan(){
    //     $data = KelembapanModel::paginate(15);
    // }
    
}
