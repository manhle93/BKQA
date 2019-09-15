<?php

namespace App\Http\Controllers;

use App\CauHoi;
use Illuminate\Http\Request;

class CauHoiController extends Controller
{
    public function index(){
        $cauHois = CauHoi::query()->paginate(3);
        return view('welcome', compact('cauHois'));
    }
}
