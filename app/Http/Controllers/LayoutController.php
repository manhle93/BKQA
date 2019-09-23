<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CauHoi;
use App\CauTraLoi;
use App\ChuDe;

class LayoutController extends Controller
{
    public function timKiem($data)
    {
        
        if (isset($data)) {
            $tukhoa = trim($data);
            $ketqua = CauHoi::where('tieu_de', 'like', "%{$tukhoa}%")
                ->orWhere('noi_dung', 'like', "%{$tukhoa}%")->get();
            return view('timkiem', ['tukhoa'=>3333, 'ketqua'=>$ketqua]);
        } 
    }
    public function kiemtraDangNhap()
    {
        $user = auth()->user();
        return response()->json([
            'data' => $user
        ],200);
    }
    public function thongTinCaNhan(){
        $user = auth()->user();
        return view('canhan', ['user'=>$user]);
    }
}
