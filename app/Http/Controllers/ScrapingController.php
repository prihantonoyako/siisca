<?php

namespace App\Http\Controllers;

use App\Models\Table\ArahAnginModel;
use App\Models\Table\CuacaModel;
use App\Models\Table\KecepatanAnginModel;
use App\Models\Table\KelembapanModel;
use App\Models\Table\StatistikModel;
use App\Models\Table\SuhuModel;
use App\Models\Table\WilayahModel;
use DOMDocument;
use DateTime;

class ScrapingController extends Controller
{
    //scrap area
    public function tambah_area()
    {
        $dom = new DOMDocument;
        $dom->load("https://data.bmkg.go.id/DataMKG/MEWS/DigitalForecast/DigitalForecast-Indonesia.xml");
        $areas = $dom->getElementsByTagName('area');
        foreach ($areas as $area) {
            $wilayah = new WilayahModel;
            $wilayah->area_id = $area->getAttribute('id');
            $wilayah->provinsi = $area->getAttribute('domain');
            $wilayah->save();
            echo $area->getAttribute('id') . "<br>";
            echo $area->getAttribute('domain');
            echo "<br>";
            /*foreach($area->getElementsByTagName('parameter') as $item){
               echo $item->getAttribute('id');
               echo "<br>";
           }
           echo "<br>";
           */
        }
    }

    public function scrap()
    {
        $doc = new DOMDocument;
        $doc->load("https://data.bmkg.go.id/DataMKG/MEWS/DigitalForecast/DigitalForecast-Indonesia.xml");
        $xpath = new \DOMXPath($doc);
        $wilayah = new WilayahModel();

        //Extract area_id from DB::wilayah
        $wilayah_id = $wilayah->pluck('area_id');
       
        foreach ($wilayah_id as $area_id) {

            //Extract data kelembapan
            $query = "/data/forecast/area[@id=$area_id]/parameter[@id='hu']/timerange";
            $entries = $xpath->query($query);
            foreach ($entries as $entry) {
                $timerange = $entry->getAttribute('datetime');
                $date = $this->getTime($timerange);
                $kelembapan = new KelembapanModel([
                    'kelembapan' => trim($entry->nodeValue),
                    'timerange' => $date
                ]);
                $wilayah_model = WilayahModel::find($area_id);
                $wilayah_model->kelembapan()->save($kelembapan);
            }

            //Extract data suhu
            $query = "/data/forecast/area[@id=$area_id]/parameter[@id='t']/timerange";
            $entries = $xpath->query($query);
            foreach ($entries as $entry) {
                $timerange = $entry->getAttribute('datetime');
                $date = $this->getTime($timerange);
                $querySuhu = "/data/forecast/area[@id=$area_id]/parameter[@id='t']/timerange[@datetime=$timerange]/value";
                $valueSuhu = $xpath->query($querySuhu);
                $suhu = new SuhuModel([
                    'area_id' => $area_id,
                    'celcius' => $valueSuhu->item(0)->nodeValue,
                    'fahrenheit' => $valueSuhu->item(1)->nodeValue,
                    'timerange' => $date
                ]);
                $wilayah_model = WilayahModel::find($area_id);
                $wilayah_model->suhu()->save($suhu);
            }

            //Extract data arah angin
            $query = "/data/forecast/area[@id=$area_id]/parameter[@id='wd']/timerange";
            $entries = $xpath->query($query);
            foreach ($entries as $entry) {
                $timerange = $entry->getAttribute('datetime');
                $date = $this->getTime($timerange);
                $queryArahAngin = "/data/forecast/area[@id=$area_id]/parameter[@id='wd']/timerange[@datetime=$timerange]/value";
                $valueArahAngin = $xpath->query($queryArahAngin);
                $arah_angin = new ArahAnginModel([
                    'area_id' => $area_id,
                    'deg' => $valueArahAngin->item(0)->nodeValue,
                    'card' => $valueArahAngin->item(1)->nodeValue,
                    'sexa' => $valueArahAngin->item(2)->nodeValue,
                    'timerange' => $date,
                ]);
                $wilayah_model = WilayahModel::find($area_id);
                $wilayah_model->arah_angin()->save($arah_angin);
            }

            //Extract data Cuaca
            $query = "/data/forecast/area[@id=$area_id]/parameter[@id='weather']/timerange";
            $entries = $xpath->query($query);
            foreach ($entries as $entry) {
                $timerange = $entry->getAttribute('datetime');
                $date = $this->getTime($timerange);
                $cuaca = new CuacaModel([
                    'area_id' => $area_id,
                    'cuaca' => trim($entry->nodeValue),
                    'timerange' => $date
                ]);
                $wilayah_model = WilayahModel::find($area_id);
                $wilayah_model->cuaca()->save($cuaca);
            }

            //Extract data kecepatan angin
            $query = "/data/forecast/area[@id=$area_id]/parameter[@id='ws']/timerange";
            $entries = $xpath->query($query);
            foreach ($entries as $entry) {
                $timerange = $entry->getAttribute('datetime');
                $date = $this->getTime($timerange);
                $queryKecepatanAngin = "/data/forecast/area[@id=$area_id]/parameter[@id='ws']/timerange[@datetime=$timerange]/value";
                $valueKecepatanAngin = $xpath->query($queryKecepatanAngin);
                $kecepatan_angin = new KecepatanAnginModel([
                    'area_id' => $area_id,
                    'knot' => $valueKecepatanAngin->item(0)->nodeValue,
                    'mph' => $valueKecepatanAngin->item(1)->nodeValue,
                    'kph' => $valueKecepatanAngin->item(2)->nodeValue,
                    'ms' => $valueKecepatanAngin->item(3)->nodeValue,
                    'timerange' => $date
                ]);
                $wilayah_model = WilayahModel::find($area_id);
                $wilayah_model->kecepatan_angin()->save($kecepatan_angin);
            }
        }
    }
    public function getTime($timerange)
    {
        $year = substr($timerange, 0, 4);
        $month = substr($timerange, 4, 2);
        $day = substr($timerange, 6, 2);
        $hour = substr($timerange, 8, 2);
        $format = $year . "-" . $month . "-" . $day . " " . $hour . ":" . "00:00";
        $date = DateTime::createFromFormat('Y-m-d H:i:s', $format);
        return $date;
    }
}
