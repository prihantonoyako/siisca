<?php

namespace App\Models\Table;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KecepatanAnginModel extends Model
{
    protected $table = 'kecepatan_angin';
    protected $fillable = [
        'area_id',
        'knot',
        'mph',
        'kph',
        'ms',
        'timerange'
    ];
    public function wilayah()
    {
        return $this->belongsTo(WilayahModel::class,'area_id','area_id');
    }
}
