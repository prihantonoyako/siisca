<?php

namespace App\Models\Pengguna;

use App\Models\Pengguna\RolePenggunaModel;
use App\Models\Registration;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;

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
        'is_aktif',
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

    public function setIsAktifAttribute($value){
        $this->attributes['is_aktif'] = $value;
    }

    public function registration(){
        return $this->hasOne(Registration::class);
    }

    public function getRegisteredAttribute(){
        return Carbon::createFromFormat('Y-m-d H:i:s', "{$this->created_at}")->format('d/m/Y');
    }

    public function getUpdateProfileAttribute(){
        $updatedAt = Carbon::createFromFormat('Y-m-d H:i:s', "{$this->updated_at}");
        $sinceWhen = $updatedAt->diffInDays(Carbon::now());
        $sinceClause = "days ago";
        if($sinceWhen>30){
            $sincewhen = $updatedAt->diffInMonths(Carbon::now());
            $sinceClause = "months ago";
            if($sinceWhen>12){
                $sinceWhen = $updatedAt->diffInYears(Carbon::now());
                $sinceClause = "years ago";
            }
        }
        $updatedAt = $updatedAt->format('d/m/Y');
        return $updatedAt . " (" . $sinceWhen . $sinceClause . ")";
    }

}
