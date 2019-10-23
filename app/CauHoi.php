<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CauHoi extends Model
{
    protected $fillable = [
        'tieu_de',
        'noi_dung',
        'so_cau_tra_loi',
        'chu_de_id',
        'trang_thai',
        'user_id',
    ];
    public function user() {
        return $this->belongsTo('App\User');
    }
    public function chuDe() {
        return $this->belongsTo('App\ChuDe');
    }
    public function cauTraLois()
    {
        return $this->hasMany('App\CauTraLoi');
    }
    public function thes()
    {
        return $this->belongsToMany('App\The');
    }
    public function thongBao()
    {
        return $this->hasMany('App\ThongBao');
    }
    public function baoCaoViPham()
    {
        return $this->hasMany('App\BaoCaoViPham', 'cau_hoi_bao_cao_id', 'id');
    }
}
