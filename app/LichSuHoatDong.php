<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LichSuHoatDong extends Model
{
    protected $fillable = [
        'noi_dung',
        'user_id'
    ];
    public function user() {
        return $this->belongsTo('App\User');
    }
}
