<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ThongBao extends Model
{
    protected $fillable = [
        'user_id',
        'cau_tra_loi_id',
        'cau_hoi_id',
        'noi_dung',
        'user_tra_loi_id'
    ];
    public function cauHoi()
    {
        return $this->belongsTo('App\CauHoi');
    }
    public function cauTraLoi()
    {
        return $this->belongsTo('App\CauTraLoi');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function userTraLoi()
    {
        return $this->belongsTo('App\User');
    }
}
