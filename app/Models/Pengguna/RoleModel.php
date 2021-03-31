<?php

namespace App\Models\Pengguna;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleModel extends Model
{
    use HasFactory;

    protected $table = 'role';
    protected $primaryKey = 'id_role';
    protected $fillable = [
        'nama_role',
        'url'
    ];

    public function hasAkses() {
        return $this->hasMany(AksesModel::class,'id_role','id_role');
    }
}
