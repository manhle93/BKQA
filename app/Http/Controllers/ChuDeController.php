<?php

namespace App\Http\Controllers;

use App\ChuDe;
use App\CauHoi;
use Illuminate\Http\Request;
use Validator;


class ChuDeController extends Controller
{
    public function index()
    {
        $chuDes = ChuDe::query()->with('user')->get();
        return view('welcome', ['chuDes' => $chuDes]);
    }
    public function getChuDe()
    {
        $chuDes = ChuDe::query()->with('user')->get();
        return response()->json([
            'message' => 'lấy dữ liệu thành công',
            'data' => $chuDes,
            'code' => 200
        ], 200);
    }
    public function add(Request $request)
    {
        $data = $request->all();
        $user = auth()->user();
        $quyen = $user->quyen_id;
        if ($quyen == 1 || $quyen == 2) {
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
            }
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
                        'code' => '500',
                        'message' => 'Thất bại',
                    ],
                    500
                );
            }
        } else {
            return  response()->json(
                [
                    'code' => '500',
                    'message' => 'Không có quyền thêm chủ đề',
                ],
                500
            );
        }
    }
    public function delete($id)
    {
        $user = auth()->user();
        $quyen = $user->quyen_id;
        if ($quyen == 1 || $quyen == 2) {
            try {
                ChuDe::find($id)->delete();

                return response()->json([
                    'message' => 'Xóa thành công',
                    'code' => 200,
                    'data' => '',
                ], 200);
            } catch (\Exception $e) {
                return response()->json([
                    'message' => 'Lỗi, không thể xóa chủ đề này',
                    'code' => 500,
                    'data' => $e,
                ], 500);
            }
        } else {
            return response()->json([
                'message' => 'Không có quyền xóa chủ đề',
                'code' => 500
            ], 500);
        }
    }
    public function edit(Request $request, $id)
    {
        $user = auth()->user();
        $data = $request->all();
        $quyen = $user->quyen_id;
        if ($quyen == 1 || $quyen == 2) {
            $validator = Validator::make($data, [
                'tieu_de' => 'required',
                'mo_ta' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'code' => 400,
                    'message' => __('Chưa nhập đủ thông tin, không thể tạo chủ đề'),
                    'data' => [
                        $validator->errors()->all()
                    ]
                ], 400);
            }
            try {
                ChuDe::where('id', $id)->update([
                    'tieu_de' => $data['tieu_de'],
                    'mo_ta' => $data['mo_ta']
                ]);

                return response()->json([
                    'message' => 'Cập nhật thành công',
                    'code' => 200,
                    'data' => '',
                ], 200);
            } catch (\Exception $e) {
                return response()->json([
                    'message' => 'Lỗi, không thể cập nhật',
                    'code' => 500,
                    'data' => $e,
                ], 500);
            }
        } else {
            return response()->json([
                'message' => 'Không có quyền chỉnh sửa',
                'code' => 500
            ], 500);
        }
    }
    public function cauHoiThuocChuDe($id)
    {
        $chude = ChuDe::where('id', $id)->with('user')->first();
        $cauHois = CauHoi::query()->where('chu_de_id', $id)->with('chuDe', 'user')->get();
        return view('cauhoichude', compact(['cauHois', 'chude']));
    }
}
