<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatistikModel extends Model
{
    protected $table = 'statistik';
    protected $fillable = [
        'min_humidity',
        'max_humidity',
        'min_temperature_celcius',
        'min_temperature_fahrenheit',
        'max_temperature_celcius',
        'max_temperature_fahrenheit',
        'timerange'
    ];
    public function wilayah()
    {
        return $this->belongsTo(WilayahModel::class,'area_id','area_id');
    }
}
