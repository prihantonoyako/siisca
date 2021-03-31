<?php

namespace App\Models\Pengguna;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AksesModel extends Model
{
    use HasFactory;
    protected $table = 'akses';
    protected $primaryKey = 'id_akses';
    protected $fillable = [
        'id_role',
        'id_menu',
        'nomor_urut_menu',
        'is_aktif'
    ];

    public function belongsRole(){
        return $this->belongsTo(RoleModel::class,'id_role','id_role');
    }
}
