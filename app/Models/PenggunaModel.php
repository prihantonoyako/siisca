<?php

namespace App\Models;
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
}
