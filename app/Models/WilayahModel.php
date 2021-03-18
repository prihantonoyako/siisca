<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WilayahModel extends Model
{
    //use HasFactory;
    protected $table = 'wilayah';
    protected $primaryKey = 'area_id';
    protected $fillable = [
        'kelurahan',
        'kecamatan',
        'kabupaten_kota',
        'provinsi'
    ];
    public function suhu()
    {
        return $this->hasMany(SuhuModel::class,'area_id','area_id');
    }
    public function statistik()
    {
        return $this->hasMany(StatistikModel::class,'area_id','area_id');
    }
    public function kelembapan()
    {
        return $this->hasMany(KelembapanModel::class,'area_id','area_id');
    }
    public function kecepatan_angin()
    {
        return $this->hasMany(KecepatanAnginModel::class,'area_id','area_id');
    }
    public function cuaca()
    {
        return $this->hasMany(CuacaModel::class,'area_id','area_id');
    }
    public function arah_angin()
    {
        return $this->hasMany(ArahAnginModel::class,'area_id','area_id');
    }
}
