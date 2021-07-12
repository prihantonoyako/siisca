<?php

namespace App\Http\Traits;

use App\Models\Table\CuacaModel;
use App\Models\Table\KecepatanAnginModel;
use App\Models\Table\ArahAnginModel;
use App\Models\Table\KelembapanModel;
use App\Models\Table\SuhuModel;
use App\Models\Table\WilayahModel;
use Illuminate\Support\Carbon;

trait WeatherTrait
{
    function check_datetime_suggestion(){
        $dateSuggest = SuhuModel::first()->value('timerange');
        return $dateSuggest;
    }

    private function check_datetime_exist($time){
        $dateExist = SuhuModel::where('timerange','<=',$time)->exists();
        if(!$dateExist){
            return false;
        }
        return true;
    }

    private function check_datetime_null($time,$subDays=0){
        if(is_null($time)){
            $dummyDate = Carbon::now('Asia/Jakarta')->subDays($subDays)->setMinute(0)->setSecond(0)->format('Y-m-d H:i:s');
            return $dummyDate;
        }
        $dummyDate = Carbon::createFromFormat('Y-m-d H:i',$time,'Asia/Jakarta')->setMinute(0)->format('Y-m-d H:i:s');
        return $dummyDate;
    }

    private function check_data_exist($data){
        foreach($data as $val){
            if(is_null($val)){
                return false;
            }
        }
        return true;
    }
    
    private function get_suhu($idArea,$time,$field){
        $suhu = SuhuModel::where('area_id',$idArea)->where('timerange',$time)->value($field);
        if(!is_null($suhu)){
            switch($field){
                case "celcius":
                    return (int) $suhu;
                case "fahrenheit":
                    return (float) $suhu;
            }
        }
        return;
    }

    private function get_kelembapan($area_id, $time)
    {
        $kelembapan = KelembapanModel::where('area_id',$area_id)->where('timerange',$time)->value('kelembapan');
        if(!is_null($kelembapan)){return (int) $kelembapan;}
        return;
    }

    private function get_cuaca_kode($area_id, $time)
    {
        $cuaca = CuacaModel::where('area_id',$area_id)->where('timerange',$time)->value('cuaca');
        $light = $time->hour;
        if(!is_null($cuaca)){
            if($cuaca == 4 || $cuaca == 45){
                $icon = "yr.no/".$cuaca.".svg";
                $icon = asset($icon);
                return $icon;
            }
            if($light >= 6 && $light <= 16) {
                $icon = "yr.no/".$cuaca.'d'.".svg";
                $icon = asset($icon);
                return $icon;
            }else{
                $icon = "yr.no/".$cuaca.'n'.".svg";
                $icon = asset($icon);
                return $icon;
            }
        }
        return;
    }

    private function get_arah_angin($idArea,$time,$field){
        $arahAngin = ArahAnginModel::where('area_id',$idArea)->where('timerange',$time)->value($field);
        if(!is_null($arahAngin)){return (int) $arahAngin;}
        return;
    }

    private function get_kecepatan_angin($idArea,$time,$field){
        $kecepatanAngin = KecepatanAnginModel::where('area_id',$idArea)->where('timerange',$time)->value($field);
        if(!is_null($kecepatanAngin)){
            $kecepatanAngin = round($kecepatanAngin,2,PHP_ROUND_HALF_UP);
            return $kecepatanAngin;
        }
        return;
    }

    public function showStatistik($area_id, $fromDate, $toDate)
    {
        $fromNotNull = $this->check_datetime_null($fromDate,3);
        $toNotNull = $this->check_datetime_null($toDate);
        $fromExist = $this->check_datetime_exist($fromNotNull);
        if(!$fromExist){
            return false;
        }
        $from = Carbon::createFromFormat('Y-m-d H:i:s',$fromNotNull,'Asia/Jakarta');
        $to = Carbon::createFromFormat('Y-m-d H:i:s',$toNotNull,'Asia/Jakarta');
        $nama_wilayah = WilayahModel::find($area_id)->value('provinsi');
        $statistik = array("wilayah"=>$nama_wilayah);
        $statistik["data"] = array();
        for(;$from->lessThanOrEqualTo($to);$from->addHours(1)){
            //February 18, 2018 12:30 PM
            $temp["datetime"] = $from->format('Y-m-d H:i:s');
            $temp["cuacaKode"] = $this->get_cuaca_kode($area_id,$from);
            $temp["cuacaNama"] = "cerah";
            // $temp["suhuFahrenheit"] = $this->get_suhu($area_id,$from,'fahrenheit');
            $temp["suhuCelcius"] = $this->get_suhu($area_id,$from,'celcius');
            $temp["kelembapan"] = $this->get_kelembapan($area_id,$from);
            $temp["arahAngin"] = $this->get_arah_angin($area_id,$from,'deg');
            $temp["kecepatanAngin"] = $this->get_kecepatan_angin($area_id,$from,'mph');
            $dataPresent = $this->check_data_exist($temp);
            if($dataPresent){array_push($statistik["data"],$temp);}
        }
        return $statistik;
    }
}
