<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KelembapanModel extends Model
{
    protected $table = 'kelembapan';
    protected $fillable = [
        'area_id',
        'kelembapan',
        'timerange'
    ];
    public function wilayah()
    {
        return $this->belongsTo(WilayahModel::class,'area_id','area_id');
    }
}
