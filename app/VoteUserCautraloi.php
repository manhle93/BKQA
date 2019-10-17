<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VoteUserCautraloi extends Model
{
    protected $fillable = [
        'user_id',
        'cau_tra_loi_id',
        'cau_hoi_id'
    ];
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function cauTraLoi()
    {
        return $this->belongsTo('App\CauTraLoi');
    }
    public function cauHoi()
    {
        return $this->belongsTo('App\CauHoi');
    }
}
