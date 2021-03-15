<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArahAnginModel extends Model
{
    protected $table = 'arah_angin';
    protected $primaryKey = 'area_id';
    protected $fillable = ['provinsi'];
}
