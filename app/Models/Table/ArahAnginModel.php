<?php

namespace App\Models\Table;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArahAnginModel extends Model
{
    protected $table = 'arah_angin';
    protected $fillable = [
        'area_id',
        'deg',
        'card',
        'sexa',
        'timerange'
    ];
    public function wilayah()
    {
        return $this->belongsTo(WilayahModel::class,'area_id','area_id');
    }
}
