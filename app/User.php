<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'anh_dai_dien', 'so_thong_bao', 'quyen_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function cauTraLois()
    {
        return $this->hasMany('App\CauTraLoi');
    }
    public function cauHois()
    {
        return $this->hasMany('App\CauHoi');
    }
    public function votes()
    {
        return $this->hasMany('App\VoteUserCatraloi');
    }
    public function quyen()
    {
        return $this->belongsTo('App\Quyen');
    }
    public function thongBao()
    {
        return $this->hasMany('App\ThongBao');
    }
    public function baoCaoViPham()
    {
        return $this->hasMany('App\BaoCaoViPham');
    }
}
