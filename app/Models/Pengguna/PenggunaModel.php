<?php

namespace App\Models\Pengguna;

use App\Models\Pengguna\RolePenggunaModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
class PenggunaModel extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $guard = 'pengguna';
    protected $table = 'pengguna';
    protected $primaryKey = 'id_pengguna';
    protected $fillable = [
        'username',
        'password',
        'nama_depan',
        'nama_belakang',
        'email',
        'foto',
    ];
    protected $hidden = [
        'password'
    ];

    public function hasRole() {
        return $this->hasMany(RolePenggunaModel::class,'id_pengguna','id_pengguna');
    }

    public function getNamaPenggunaAttribute(){
        return "{$this->nama_depan} {$this->nama_belakang}";
    }
}
