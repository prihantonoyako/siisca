<?php

namespace App\Http\Controllers;

use DOMDocument;
use Illuminate\Http\Request;
use App\Models\WilayahModel;
use SimpleXMLElement;

class WeatherController extends Controller
{
    public function index(){

    }
    public function tambah_area(){
        $dom = new DOMDocument;
        $dom->load("https://data.bmkg.go.id/DataMKG/MEWS/DigitalForecast/DigitalForecast-Indonesia.xml");
        $areas = $dom->getElementsByTagName('area');
        foreach($areas as $area) {
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
    public function cuaca(){
        $xml = simplexml_load_file(asset('DigitalForecast-Indonesia.xml'));
        $result = $xml->xpath("/data/forecast/area[@id='501397']/parameter[@id='weather']");
        print_r($result);
    }
}
