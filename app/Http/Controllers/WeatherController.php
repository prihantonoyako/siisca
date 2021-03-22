<?php

namespace App\Http\Controllers;

use DOMDocument;
use Illuminate\Http\Request;
use App\Models\Table\WilayahModel;
use SimpleXMLElement;

class WeatherController extends Controller
{
    public function index(){

    }
    
    public function cuaca(){
        $xml = simplexml_load_file(asset('DigitalForecast-Indonesia.xml'));
        $result = $xml->xpath("/data/forecast/area[@id='501397']/parameter[@id='weather']");
        print_r($result);
    }
}
