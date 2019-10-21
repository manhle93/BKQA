<?php

namespace App\Http\Controllers;

use App\User;
use Exception;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Hàm lấy danh sách thành viên
    public function index()
    {
        $user = User::query()->with('quyen')->get();
        return response()->json([
            'message' => 'Lấy thông tin tài khoản thành công',
            'data' => $user,
            'code' => 200
        ], 200);
    }
    public function setQuyen(Request $request, $id)
    {
        $user = auth()->user();
        $user_set = User::where('id', $id)->first();
        $quyen =  $request->get('quyen_id');
        if ($user->quyen_id == 1) {
            User::where('id', $id)->update([
                'quyen_id' => $quyen
            ]);
            return response()->json([
                'message' => 'Đặt quyền thành công',
                'code' => 200,
                'data' => ''
            ], 200);
        }
        if ($user->quyen_id == 2) {
            if ($user_set->quyen_id == 1) {
                return response()->json([
                    'message' => 'Không thể thay đổi quyền của admin',
                    'code' => 400,
                    'data' => ''
                ], 400);
            }
            if ($quyen == 1) {
                return response()->json([
                    'message' => 'Không thể đặt quyền admin',
                    'code' => 400,
                    'data' => ''
                ], 400);
            };
            User::where('id', $id)->update([
                'quyen_id' => $quyen
            ]);
            return response()->json([
                'message' => 'Đặt quyền thành công',
                'code' => 200,
                'data' => ''
            ], 200);
        }
        if ($user->quyen_id == 3 || $user->quyen_id == 4) {
            return response()->json([
                'message' => 'Không thể thay đổi quyền',
                'code' => 400,
                'data' => ''
            ], 400);
        }
    }
    public function docThongBao()
    {
        $user = auth()->user();
        try {
            User::where('id', $user->id)->update([
                'so_thong_bao' => 0
            ]);
            return response()->json([
                'message' => 'Đọc thông báo',
                'code' => 200,
                'data'=> ''
            ],200);
        } catch (\Exception $e) {
            return response()->json(
                [
                    'code' => 400,
                    'message' => 'Thất bại',
                    'data'=>$e
                ],
                400
            );
         }
    }
}
