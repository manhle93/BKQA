<?php

namespace App\Http\Controllers;

use App\ChuDe;
use App\CauHoi;
use Illuminate\Http\Request;

class ChuDeController extends Controller
{
    public function index(){
        $chuDes = ChuDe::query()->paginate(3);
        $cauHois = CauHoi::latest()->with('chuDe', 'user')->paginate(3);
        return view('welcome', compact(['chuDes', 'cauHois']));
    }
    public function add(Request $request){
        $data = $request->all();
        $user = auth()->user();
        $data['user_id'] = $user->id;
        $validator = Validator::make($data, [
            'tieu_de' => 'required',
            'mo_ta'=>'required',
            'user_id'=>'required'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'code' => 400,
                'message' => __('Chưa nhập đủ thông tin, không thể tạo chủ đề'),
                'data' => [
                    $validator->errors()->all()
                ]
            ],400);
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
}
