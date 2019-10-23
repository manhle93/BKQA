<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CauHoi;
use App\CauTraLoi;
use App\ChuDe;
use App\HopThu;
use App\LichSuHoatDong;
use App\Quyen;
use App\ThongBao;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Validator;



class LayoutController extends Controller
{
    public function timKiem($data)
    {
        if (isset($data)) {
            $tukhoa = trim($data);
            $ketqua = CauHoi::where('tieu_de', 'like', "%{$tukhoa}%")
                ->orWhere('noi_dung', 'like', "%{$tukhoa}%")->with('user', 'chuDe')->get();
            return view('timkiem', ['tukhoa' => $tukhoa, 'ketqua' => $ketqua]);
        }
    }
    public function formTimKiemNangCao()
    {
        return view('timkiemnangcao');
    }
    public function timKiemNangCao(Request $request)
    {
        $tu_ngay = $request->get('tu_ngay');
        $den_ngay = $request->get('den_ngay');
        $user = $request->get('user');
        $noidung = $request->get('noidung');
        $nguoidung = User::query();
        $cau_hoi = CauHoi::query()->with('user', 'chuDe');
        $cau_hoi_user = null;
        $user_id = [];
        if (empty($user)) {
            $nguoidung = null;
        }
        if (!empty($tu_ngay)) {
            $cau_hoi->where('created_at', '>=', Carbon::parse($tu_ngay));
        }
        if (!empty($den_ngay)) {
            $cau_hoi->where('created_at', '<', Carbon::parse($den_ngay)->addDays(1));
        }
        if (!empty($noidung)) {
            $noidung = trim($noidung);
            $cau_hoi->where('tieu_de',  'like', "%{$noidung}%")
                ->orWhere('noi_dung', 'like', "%{$noidung}%");
        }
        if (!empty($user)) {
            $user = trim($user);
            $nguoidung = $nguoidung->where('name', 'like', "%{$user}%")->get();
            foreach ($nguoidung as $value) {
                $user_id[] = $value->id;
            }
        }
        if (!empty($user) && !empty($noidung)) {
            $noidung = trim($noidung);
            $cau_hoi_user = CauHoi::with('user', 'chuDe')
                ->whereIn('user_id', $user_id)->where(function ($query) use ($noidung) {
                    $query->where('tieu_de',  'like', "%{$noidung}%")
                        ->orWhere('noi_dung', 'like', "%{$noidung}%");
                })
                ->get();
        }
        if (empty($noidung) && empty($tu_ngay)) {
            $cau_hoi = null;
        } else {
            $cau_hoi = $cau_hoi->get();
        }
        return response()->json([
            'message' => 'Lấy dữ liệu thành công',
            'cauhoi' => $cau_hoi,
            'user' => $nguoidung,
            'cauhoi_user' => $cau_hoi_user,
            'code' => 200
        ], 200);
    }
    public function kiemtraDangNhap()
    {
        $user = auth()->user();
        return response()->json([
            'data' => $user
        ], 200);
    }
    public function thongTinCaNhan()
    {
        // $user = auth()->user();
        $user = User::where('id', auth()->user()->id)->with('quyen')->first();
        $cauHois = CauHoi::where('user_id', $user->id)->get();
        return view('canhan', ['user' => $user, 'cauhois' => $cauHois]);
    }
    public function thongTinTaiKhoan($id)
    {
        $user =  User::where('id', $id)->with('cauHois', 'cauHois.chuDe')->first();
        return view('taikhoan', ['user' => $user]);
    }
    public function uploadAvatar(Request $request)
    {
        if ($request->file) {
            $image = $request->file;
            $name = time() . '.' . $image->getClientOriginalExtension();
            $image->move('storage/images/avatar/', $name);
            $user = User::find(auth()->user()->id);
            $user->update(['anh_dai_dien' => '/storage/images/avatar/' . $name]);
            return '/storage/images/avatar/' . $name;
        }
    }
    public function getQuyen()
    {
        $quyen = Quyen::all();
        return response()->json([
            'message' => 'Toàn bộ quyền',
            'data' => $quyen,
            'code' => 200
        ], 200);
    }
    public function getThongBao()
    {
        $user = auth()->user();
        $thongbao = ThongBao::where('user_id', $user->id)->with('cauHoi', 'cauTraLoi', 'user', 'userTraLoi')->orderBy('created_at', 'desc')->get();
        return response()->json([
            'message' => 'lấy thông báo thành công',
            'code' => 200,
            'data' => $thongbao
        ], 200);
    }
    public function getLichSuHoatDong()
    {
        $user = auth()->user();
        $info = LichSuHoatDong::where('user_id', $user->id)->with('user')->get();
        return response()->json([
            'message' => 'Lấy lịch sử hoạt động thành công',
            'data' => $info,
            'code' => 200
        ], 200);
    }
    public function guiThu(Request $request)
    {
        $data = $request->all();
        $user = auth()->user();
        $data['user_gui_id'] = $user->id;
        $validator = Validator::make($data, [
            'noi_dung' => 'required',
            'user_nhan_id' => 'required',
            'user_gui_id' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'code' => 400,
                'message' => __('Chưa nhập đủ thông tin, Không thể gửi thư'),
                'data' => [
                    $validator->errors()->all()
                ]
            ], 400);
        }
        try {
            HopThu::create($data);
            return response()->json(
                [
                    'code' => 200,
                    'message' => 'Thành công',
                    'data' => $data
                ],
                200
            );
        } catch (\Exception $e) {
            return response()->json(
                [
                    'code' => 400,
                    'message' => 'Thất bại',
                    'data'=> $e
                ],
                400
            );
        }
    }
    public function getThu(){
        $user = auth()->user();
        $thu_da_gui = HopThu::where('user_gui_id', $user->id)->with('user_gui', 'user_nhan')->get();
        $thu_den = HopThu::where('user_nhan_id', $user->id)->with('user_nhan', 'user_gui')->get();
        return response()->json(
            [
                'code' => 200,
                'message' => 'Thành công',
                'thugui' => $thu_da_gui,
                'thuden' => $thu_den
            ],
            200
        );
    }
}
