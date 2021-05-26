<?php

namespace App\Http\Traits;

use App\Models\Table\CuacaModel;
use App\Models\Table\KecepatanAnginModel;
use App\Models\Table\KelembapanModel;
use App\Models\Table\SuhuModel;
use App\Models\Table\WilayahModel;
use Illuminate\Support\Carbon;

trait WeatherTrait {
    
    public function getSuhu($area_id,$fromDate,$toDate) {
        $suhu = SuhuModel::where([
            ['area_id','=',$area_id],
            ['timerange','>=',$fromDate],
            ['timerange','<=',$toDate]
        ])->get();
        return $suhu;
    }

    public function getKelembapan($area_id,$fromDate,$toDate) {
        $kelembapan = KelembapanModel::where([
            ['area_id','=',$area_id],
            ['timerange','>=',$fromDate],
            ['timerange','<=',$toDate]
        ])->get();

        return $kelembapan;
    }

    public function getCuaca($area_id,$fromDate,$toDate) {
        $cuaca = CuacaModel::where([
            ['area_id','=',$area_id],
            ['timerange','=',$fromDate]
        ])->pluck('cuaca');
        $data = array();
        foreach($cuaca as $item){
           array_push($data,trim($item));
        }
        return $data;
    }

    public function showStatistik($area_id,$fromDate,$toDate) {
        $area_empty = is_null($area_id);
        $from_empty = is_null($fromDate);
        $to_empty = is_null($toDate);
        if($area_empty||$from_empty||$to_empty){
            $area_id = WilayahModel::first()->area_id;
            // $fromDate = Carbon::now()->format('Ymd');
            // $fromDate .= '0000';
            // $toDate = Carbon::now()->addDays(2)->format('Ymd');
            // $toDate .= '0000';
            // $fromDate = '2021-04-15 00:00:00';
            // $toDate = '2021-04-17 18:00:00';
            // $fromDate = '202104150000';
            // $toDate = '202104170000';
            // $fromDate = Carbon::createFromFormat('Y-m-d H:i:s',$start);
            // $toDate = Carbon::createFromFormat('Y-m-d H:i:s',$end);
            // $fromDate = date('Y-m-d H:i:s', strtotime($start));
            // $toDate = date('Y-m-d H:i:s', strtotime($end));
        }

        $statistik = array(
            'suhu' => $this->getCuaca($area_id,$fromDate,$toDate)
        );
        dd($statistik);
        return $statistik;
    }

}