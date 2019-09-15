<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CauTraLoi extends Model
{
    protected $fillable = [
        'noi_dung',
        'votes',
        'cau_hoi_id',
        'user_id'
    ];
    public function user() {
        return $this->belongsTo('App\User');
    }
    public function cauHoi() {
        return $this->belongsTo('App\CauHoi');
    }
}
