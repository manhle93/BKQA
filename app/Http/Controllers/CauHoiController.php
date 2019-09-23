<?php

namespace App\Http\Controllers;

use App\CauHoi;
use App\CauTraLoi;
use App\ChuDe;
use Illuminate\Http\Request;
use Validator;

class CauHoiController extends Controller
{
    public function index()
    {
        $cauHois = CauHoi::query()->with('chuDe', 'user')->orderBy('created_at', 'desc')->get();
        $chuDes = ChuDe::query()->get();
        return view('cauhois', compact(['cauHois', 'chuDes']));
    }
    public function cauHoiMoi(){
        $cauHois = CauHoi::query()->with('chuDe', 'user')->orderBy('created_at', 'desc')->simplePaginate(3);;
        return response()->json([
            'data'=>$cauHois,
            'code'=> 200
        ],200);
    }

    public function add(Request $request)
    {
        $data = $request->all();
        $user = auth()->user();
        $data['user_id'] = $user->id;
        $chu_de_id = $data['chu_de_id'];
        $so_cau_hoi = ChuDe::where('id', $chu_de_id)->first();
        $validator = Validator::make($data, [
            'tieu_de' => 'required',
            'noi_dung' => 'required',
            'user_id' => 'required',
            'chu_de_id' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'code' => 400,
                'message' => __('Chưa nhập đủ thông tin, không thể tạo câu hỏi'),
                'data' => [
                    $validator->errors()->all()
                ]
            ], 400);
        }
        try {
            CauHoi::create($data);
            ChuDe::where('id', $chu_de_id)->update([
                'so_cau_hoi' => $so_cau_hoi['so_cau_hoi'] + 1
            ]);
            return response()->json([
                'message' => 'thành công',
                'code' => 200
            ], 200);
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
    public function showFormAdd()
    {
        $chude = ChuDe::query()->get();
        return view('nhapcauhoi', compact(['chude']));
    }
    public function show($id)
    {
        $cauHoi = CauHoi::query()->where('id', $id)->with('chuDe', 'user', 'cauTraLois', 'cauTraLois.user')->first();
        return view('binhluan', compact(['cauHoi']));
    }
}
