<?php

namespace App\Models\Pengguna;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuGroupModel extends Model
{
    use HasFactory;
    protected $table = 'menu_group';
    protected $primaryKey = 'id_group';
    protected $fillable = [
        'nama_group',
        'icon'
    ];

    public function hasMenu(){
        return $this->hasMany(MenuModel::class,'id_group','id_group');
    }
}
