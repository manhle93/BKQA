<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HopThu extends Model
{
    protected $fillable = [
        'noi_dung',
        'user_nhan_id',
        'user_gui_id'
    ];
    public function user_gui() {
        return $this->belongsTo('App\User', 'user_gui_id', 'id');
    }
    public function user_nhan() {
        return $this->belongsTo('App\User', 'user_nhan_id', 'id');
    }
}
