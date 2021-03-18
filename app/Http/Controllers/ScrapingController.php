<?php

namespace App\Http\Controllers;

use App\Models\ArahAnginModel;
use App\Models\CuacaModel;
use App\Models\KecepatanAnginModel;
use App\Models\KelembapanModel;
use App\Models\StatistikModel;
use App\Models\SuhuModel;
use App\Models\WilayahModel;
use DOMDocument;

class ScrapingController extends Controller
{
    public function scrap()
    {
        $doc = new DOMDocument;
        $doc->load(asset('DigitalForecast-Indonesia.xml'));
        $xpath = new \DOMXPath($doc);
        $wilayah = new WilayahModel();
        //Extract area_id from DB::wilayah
        $wilayah_id = $wilayah->pluck('area_id');
        foreach ($wilayah_id as $area_id) {
            //Extract data kelembapan
            $query = "/data/forecast/area[@id=$area_id]/parameter[@id='hu']/timerange";
            $entries = $xpath->query($query);
            foreach ($entries as $entry) {
                // echo $area_id;
                // echo "<br>";
                $kelembapan = new KelembapanModel([
                    'kelembapan' => $entry->nodeValue,
                    'timerange' => $entry->getAttribute('datetime')
                ]);
                $wilayah_model = WilayahModel::find($area_id);
                $wilayah_model->kelembapan()->save($kelembapan);
            }
/*
            //Extract data statistik
            $query = "/data/forecast/area[@id=$area_id]/parameter[@id='tmin' or @id='tmax' or @id='humin' or @id='humax']";
            $entries = $xpath->query($query);
            foreach ($entries as $entry) {
                $stat = $entry->getAttribute('id');
                $query = "/data/foreast/area[@id=$area_id]/parameter[@id=$stat]/timerange";
                $entries = $xpath->query($)
                echo "<br>";
                echo $entry->nodeName;
                echo "<br>";
                echo $entry->nodeValue;
                echo "<br>";
                // $statistik = new StatistikModel([
                //     'min_humidity' => $entry->nodeValue,
                //     'max_humidity' => 'dummymaxhum',
                //     'min_temperature' => 'dummymintemp',
                //     'max_temperature' => 'dummymaxtemp',
                //     'timerange' => $entry->getAttribute('datetime')
                // ]);
                // $wilayah->statistik()->save($statistik);
                
            }
*/
            //Extract data suhu
            $query = "/data/forecast/area[@id=$area_id]/parameter[@id='t']/timerange";
            $entries = $xpath->query($query);
            foreach ($entries as $entry) {
                $datetime = $entry->getAttribute('datetime');
                $querySuhu = "/data/forecast/area[@id=$area_id]/parameter[@id='t']/timerange[@datetime=$datetime]/value";
                $valueSuhu = $xpath->query($querySuhu);
                $suhu = new SuhuModel([
                    'area_id' => $area_id,
                    'celcius' => $valueSuhu->item(0)->nodeValue,
                    'fahrenheit' => $valueSuhu->item(1)->nodeValue,
                    'timerange' => $datetime
                ]);
                $wilayah_model = WilayahModel::find($area_id);
                $wilayah_model->suhu()->save($suhu);
            }

            //Extract data arah angin
            $query = "/data/forecast/area[@id=$area_id]/parameter[@id='wd']/timerange";
            $entries = $xpath->query($query);
            foreach ($entries as $entry) {
                $datetime = $entry->getAttribute('datetime');
                $queryArahAngin = "/data/forecast/area[@id=$area_id]/parameter[@id='wd']/timerange[@datetime=$datetime]/value";
                $valueArahAngin = $xpath->query($queryArahAngin);
                $arah_angin = new ArahAnginModel([
                    'area_id' => $area_id,
                    'deg'=> $valueArahAngin->item(0)->nodeValue,
                    'card' => $valueArahAngin->item(1)->nodeValue,
                    'sexa' => $valueArahAngin->item(2)->nodeValue,
                    'timerange' => $datetime,
                ]);
                $wilayah_model = WilayahModel::find($area_id);
                $wilayah_model->arah_angin()->save($arah_angin);
            }

            //Extract data Cuaca
            $query = "/data/forecast/area[@id=$area_id]/parameter[@id='weather']/timerange";
            $entries = $xpath->query($query);
            foreach ($entries as $entry) {
                $cuaca = new CuacaModel([
                    'area_id' => $area_id,
                    'cuaca' => $entry->nodeValue,
                    'timerange' => $entry->getAttribute('datetime')
                ]);
                $wilayah_model = WilayahModel::find($area_id);
                $wilayah_model->cuaca()->save($cuaca);
            }

            //Extract data kecepatan angin
            $query = "/data/forecast/area[@id=$area_id]/parameter[@id='ws']/timerange";
            $entries = $xpath->query($query);
            foreach ($entries as $entry) {
                $datetime = $entry->getAttribute('datetime');
                $queryKecepatanAngin = "/data/forecast/area[@id=$area_id]/parameter[@id='ws']/timerange[@datetime=$datetime]/value";
                $valueKecepatanAngin = $xpath->query($queryKecepatanAngin);
                $kecepatan_angin = new KecepatanAnginModel([
                    'area_id' => $area_id,
                    'knot' => $valueKecepatanAngin->item(0)->nodeValue,
                    'mph' => $valueKecepatanAngin->item(1)->nodeValue,
                    'kph' => $valueKecepatanAngin->item(2)->nodeValue,
                    'ms' => $valueKecepatanAngin->item(3)->nodeValue,
                    'timerange' => $datetime
                ]);
                $wilayah_model = WilayahModel::find($area_id);
                $wilayah_model->kecepatan_angin()->save($kecepatan_angin);
            }
        }
        /*
        $wilayah->statistik()->save($statistik);
        return response()->json('success',200);
        */
    }
}
