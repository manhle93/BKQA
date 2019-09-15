<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class The extends Model
{
    protected $fillable = [
        'ten_the',
    ];
    public function cauHoi()
    {
        return $this->belongsToMany('App\CauHoi');
    }
}
