<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BaoCaoViPham extends Model
{
    protected $fillable = [
        'cau_tra_loi_id',
        'user_id',
    ];
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function cauTraLoi()
    {
        return $this->belongsTo('App\CauTraLoi');
    }
}
