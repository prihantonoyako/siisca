<?php

namespace App\Models\Pengguna;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable as Notifable;

class PenggunaModel extends Authenticatable
{
    use HasFactory, Notifable;
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
}
