<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChuDe extends Model
{
    protected $fillable = [
        'tieu_de',
        'mo_ta',
        'anh_dai_dien',
        'so_cau_hoi',
        'user_id'
    ];
    public function user() {
        return $this->belongsTo('App\User');
    }
    public function cauHois()
    {
        return $this->hasMany('App\CauHoi');
    }
}
