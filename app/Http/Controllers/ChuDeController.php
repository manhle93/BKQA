<?php

namespace App\Http\Controllers;

use App\ChuDe;
use App\CauHoi;
use Illuminate\Http\Request;

class ChuDeController extends Controller
{
    public function index()
    {
        $chuDes = ChuDe::query()->with('user')->get();
        return view('welcome', ['chuDes'=>$chuDes ]);
    }
    // public function index()
    // {
    //     $chuDes = ChuDe::query()->with('user')->get();
    //     $cauHois = CauHoi::query()->with('chuDe', 'user')->orderBy('created_at', 'desc')->get();
    //     return view('welcome', ['cauHois' => $cauHois, 'chuDes'=>$chuDes ]);
    // }
    public function add(Request $request)
    {
        $data = $request->all();
        $user = auth()->user();
        $data['user_id'] = $user->id;
        $validator = Validator::make($data, [
            'tieu_de' => 'required',
            'mo_ta' => 'required',
            'user_id' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'code' => 400,
                'message' => __('Chưa nhập đủ thông tin, không thể tạo chủ đề'),
                'data' => [
                    $validator->errors()->all()
                ]
            ], 400);
            try {
                $chuDe = ChuDe::create($data);
                return response()->json(
                    [
                        'code' => 200,
                        'message' => 'Thành công',
                        'result' => $chuDe
                    ],
                    200
                );
            } catch (\Exception $e) {
                return response()->json(
                    [
                        'code' => '400',
                        'message' => 'Thất bại',
                    ],
                    400
                );
            }
        }
    }
    public function cauHoiThuocChuDe($id)
    {
        $chude = ChuDe::where('id', $id)->with('user')->first();
        $cauHois = CauHoi::query()->where('chu_de_id', $id)->with('chuDe', 'user')->get();
        return view('cauhoichude', compact(['cauHois', 'chude']));
    }

}
