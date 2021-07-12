<?php

namespace App\Models\Pengguna;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuModel extends Model
{
    use HasFactory;
    protected $table = 'menu';
    protected $primaryKey = 'id_menu';
    protected $fillable = [
        'nama_menu',
        'url_menu',
        'icon',
        'id_group',
        'urutan'
    ];

    public function belongsMenuGroup(){
        return $this->belongsTo(MenuGroupModel::class,'id_group','id_group');
    }

}
