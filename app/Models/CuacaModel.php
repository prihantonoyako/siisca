<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CuacaModel extends Model
{
    protected $table = 'cuaca';
    protected $fillable = [
        'area_id',
        'cuaca',
        'timerange'
    ];
    public function wilayah()
    {
        return $this->belongsTo(WilayahModel::class,'area_id','area_id');
    }
}
