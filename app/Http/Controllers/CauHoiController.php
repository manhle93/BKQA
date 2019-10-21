<?php

namespace App\Http\Controllers;

use App\CauHoi;
use App\User;
use App\CauTraLoi;
use App\ChuDe;
use App\ThongBao;
use Illuminate\Http\Request;
use Validator;

class CauHoiController extends Controller
{
    public function index()
    {
        $cauHois = CauHoi::query()->where('trang_thai', true)->with('chuDe', 'user')->orderBy('created_at', 'desc')->get();
        $chuDes = ChuDe::query()->get();
        return view('cauhois', compact(['cauHois', 'chuDes']));
    }
    public function cauHoiMoi()
    {
        $cauHois = CauHoi::query()->where('trang_thai', true)->with('chuDe', 'user')->orderBy('created_at', 'desc')->simplePaginate(3);;
        return response()->json([
            'data' => $cauHois,
            'code' => 200
        ], 200);
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
        $data['trang_thai'] = true;
        if ($user->quyen_id == 4) {
            $data['trang_thai'] = false;
        }
        try {
            CauHoi::create($data);
            if ($data['trang_thai']) {
                ChuDe::where('id', $chu_de_id)->update([
                    'so_cau_hoi' => $so_cau_hoi['so_cau_hoi'] + 1
                ]);
            }
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
        $cauHoi = CauHoi::query()->where('id', $id)->with('chuDe', 'user')->first();
        return view('binhluan', compact(['cauHoi']));
    }
    public function cauHoiTheoTaiKhoan($id)
    {
        $cauHois = CauHoi::where('user_id', $id)->where('trang_thai', true)->with('user', 'chuDe')->get();
        return response()->json([
            'data' => $cauHois,
            'code' => 200,
            'message' => 'Lấy dữ liệu thành công'
        ], 200);
    }
    public function xoaCauHoi($id)
    {
        $user = auth()->user();
        $cauHois = CauHoi::where('id', $id)->first();
        if ($cauHois->user_id == $user->id || $user->quyen_id == 1 || $user->quyen_id == 2) {
            try {
                CauHoi::find($id)->delete();

                return response()->json([
                    'message' => 'Xóa thành công',
                    'code' => 200,
                    'data' => '',
                ], 200);
            } catch (\Exception $e) {
                return response()->json([
                    'message' => 'Lỗi, không thể xóa câu hỏi này',
                    'code' => 500,
                    'data' => $e,
                ], 500);
            }
        }
    }
    public function pheDuyet($id)
    {
        $user = auth()->user();
        if ($user->quyen_id == 1 || $user->quyen_id == 2) {
            try {
                $cauhoi = CauHoi::where('id', $id)->first();
                $so_thong_bao = User::where('id', $cauhoi->user_id)->first();
                CauHoi::find($id)->update([
                    'trang_thai' => true
                ]);
                User::where('id', $cauhoi->user_id)->update([
                    'so_thong_bao' => (int) $so_thong_bao->so_thong_bao + 1
                ]);
                ThongBao::create([
                    'user_id'=> $cauhoi->user_id,
                    'cau_hoi_id' => $id,
                    'user_tra_loi_id'=> null,
                    'noi_dung' => 'Câu hỏi của bạn đã được phê duyệt'
                ]);
                response()->json([
                    'message' => 'Phê duyệt thành công',
                    'code' => 200,
                    'data' => ''
                ], 200);
            } catch (\Exception $e) {
                return response()->json(
                    [
                        'data'=> $e,
                        'code' => 400,
                        'message' => 'Thất bại',
                    ],
                    400
                );
            }
        }
    }
    public function cauHoiChoDuyet()
    {
        $user = auth()->user();
        if ($user->quyen_id == 1 || $user->quyen_id == 2) {
            $cauHois = CauHoi::query()->where('trang_thai', false)->with('chuDe', 'user')->orderBy('created_at', 'desc')->get();
        } else {
            $cauHois = CauHoi::query()->where('trang_thai', false)->where('user_id', $user->id)->with('chuDe', 'user')->orderBy('created_at', 'desc')->get();
        }
        return response()->json([
            'message' => 'Lấy dữ liệu thành công',
            'data' => $cauHois,
            'code' => 200
        ], 200);
    }
}
