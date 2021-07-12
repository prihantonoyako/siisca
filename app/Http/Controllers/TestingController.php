<?php

namespace App\Http\Controllers;

use App\Http\Traits\WeatherTrait;
use Illuminate\Http\Request;

class TestingController extends Controller
{
    use WeatherTrait;

    public function index(Request $request) {
        // $area_id = request('areaId');
        // $fromDate = request('fromDate');
        // $toDate = request('toDate');
        $area_id = $request->query('areaId');
        $fromDate = $request->query('fromDate');
        $toDate = $request->query('toDate');
        $statistik = $this->showStatistik($area_id,$fromDate,$toDate);
        return response()->json($statistik, 200);
    }
    // {
        //     "wilayah": Bali,
        //     "data":[
        //         {
        //             "datetime":"yyyy-mm-dd",
        //             "cuacaKode":"kode",
        //             "cuacaNama":"cloudy",
        //             "kelembapan":"xx",
        //             "suhuCelcius":"xx",
        //             "suhuFahrenheit":"xx"
        //         },
        //     ]
        // }
}
