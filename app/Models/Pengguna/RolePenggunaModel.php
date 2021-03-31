<?php

namespace App\Models\Pengguna;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RolePenggunaModel extends Model
{
    use HasFactory;
    protected $table = 'role_pengguna';
    protected $primaryKey = 'id_role_pengguna';
    protected $fillable = [
        'id_pengguna',
        'id_role'
    ];

    public function belongsRole() {
        $this->belongsTo(RoleModel::class,'id_role','id_role');
    }
}
