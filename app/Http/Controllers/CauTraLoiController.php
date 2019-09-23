<?php

namespace App\Http\Controllers;

use App\CauHoi;
use App\CauTraLoi;
use Illuminate\Http\Request;
use Validator;

class CauTraLoiController extends Controller
{
    public function add(Request $request, $id)
    {
        $data = $request->all();
        $user = auth()->user();
        $data['user_id'] = $user->id;
        $data['cau_hoi_id'] = $id;
        $so_cau_tra_loi = CauHoi::where('id', $id)->first();
        $validator = Validator::make($data, [
            'noi_dung' => 'required',
            'user_id' => 'required',
            'cau_hoi_id' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'code' => 400,
                'message' => __('Chưa nhập đủ thông tin, Không thể gửi bình luận'),
                'data' => [
                    $validator->errors()->all()
                ]
            ], 400);
        }
        try {
            $chuDe = CauTraLoi::create($data);
            CauHoi::where('id', $id)->update([
                'so_cau_tra_loi' => $so_cau_tra_loi['so_cau_tra_loi'] + 1
            ]);
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
