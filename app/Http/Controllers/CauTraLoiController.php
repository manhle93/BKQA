<?php

namespace App\Http\Controllers;

use App\BaoCaoViPham;
use App\CauHoi;
use App\CauTraLoi;
use App\ThongBao;
use App\User;
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
        $so_thong_bao = User::where('id', $so_cau_tra_loi->user_id)->first();
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
            $cautraloi = CauTraLoi::create($data);
            CauHoi::where('id', $id)->update([
                'so_cau_tra_loi' => $so_cau_tra_loi['so_cau_tra_loi'] + 1
            ]);
            if($user->id != $so_cau_tra_loi->user_id){
                User::where('id', $so_cau_tra_loi->user_id)->update([
                    'so_thong_bao' => (int) $so_thong_bao->so_thong_bao + 1
                ]);
                ThongBao::create([
                    'cau_tra_loi_id'=> $cautraloi ->id,
                    'user_id' => $so_cau_tra_loi->user_id,
                    'cau_hoi_id' => $so_cau_tra_loi->id,
                    'user_tra_loi_id' => $user->id,
                    'noi_dung' => 'Đã trả lời câu hỏi của bạn'
                ]);
            }
            return response()->json(
                [
                    'code' => 200,
                    'message' => 'Thành công',
                    'result' => $cautraloi
                ],
                200
            );
        } catch (\Exception $e) {
            return response()->json(
                [
                    'code' => 400,
                    'message' => 'Thất bại',
                ],
                400
            );
        }
    }
    public function xoaCauTraLoi($id)
    {
        $user = auth()->user();
        $cauTraLoi = CauTraLoi::where('id', $id)->first();
        $cauHoi = CauHoi::where('id', $cauTraLoi->cau_hoi_id)->first();
        if ($user->id == $cauTraLoi->user_id || $user->id == $cauHoi->user_id) {
            try {
                CauTraLoi::find($id)->delete();
                CauHoi::where('id', $cauTraLoi->cau_hoi_id)->update([
                    'so_cau_tra_loi' => $cauHoi['so_cau_tra_loi'] - 1
                ]);
                return response()->json([
                    'message' => 'Xóa thành công',
                    'code' => 200,
                    'data' => '',
                ], 200);
            } catch (\Exception $e) {
                return response()->json([
                    'message' => 'Lỗi, không thể xóa câu trả lời này',
                    'code' => 500,
                    'data' => $e,
                ], 500);
            }
        }
    }
    public function layCauTraLoi($id)
    {
        $cauTraLoi = CauTraLoi::where('cau_hoi_id', $id)->with('user', 'votes')->get();
        return response()->json([
            'message' => 'Lấy dữ liệu thành công',
            'code' => 200,
            'data' => $cauTraLoi
        ], 200);
    }
    public function baoCaoViPham($id)
    {
        $user = auth()->user();
        try {
            $daBaoCao = BaoCaoViPham::where('user_id', $user->id)->where('cau_tra_loi_id', $id)->count();
            if($daBaoCao == 0) {
                BaoCaoViPham::create([
                    'user_id' => $user->id,
                    'cau_tra_loi_id' => $id
                ]);
            }
            return response()->json([
                'message' => 'Đã báo cáo câu trả lời',
                'code' => 200,
                'data' => ''
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Có Lỗi xảy ra',
                'code' => 500,
                'data' => $e
            ], 500);
        }
    }
    public function danhSachBaoCao()
    {
        $cauTraLoi = CauTraLoi::has('baoCaoViPham')->with('user','baoCaoViPham', 'baoCaoViPham.user')->get();
        return response()->json([
            'message' => 'Lấy dữ liệu thành công',
            'code' => 200,
            'data' => $cauTraLoi
        ]);
    }
    public function boQuaViPham($id)
    {
        try {
            BaoCaoViPham::where('cau_tra_loi_id', $id)->delete();
            return response()->json([
                'message' => 'Câu trả lời không vi phạm',
                'code' => 200,
                'data' => ''
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Có Lỗi xảy ra',
                'code' => 500,
                'data' => $e
            ], 500);
        }
    }
}
