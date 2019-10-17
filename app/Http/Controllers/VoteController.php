<?php

namespace App\Http\Controllers;

use App\VoteUserCautraloi;
use Illuminate\Http\Request;


class VoteController extends Controller
{
    public function addVote(Request $request, $id)
    {
        $cau_hoi_id = $request->get('cau_hoi_id');
        $user = auth()->user();
        if ($user != null) {
            $check = VoteUserCautraloi::where('user_id', $user->id)->where('cau_tra_loi_id', $id)->get();
            if (count($check) == 0) {
                VoteUserCautraloi::create([
                    'user_id' => $user->id,
                    'cau_tra_loi_id' => $id,
                    'cau_hoi_id' => $cau_hoi_id
                ]);
                return response()->json([
                    'message' => 'Vote thành công',
                    'code' => 200,
                    'data' => [$user->id, $id]
                ], 200);
            }
        } else {
            return response()->json([
                'message' => 'Không thể vote',
                'code' => 500,
                'data' => ''
            ], 500);
        }
    }
    public function unVote($id){
        $user = auth()->user();
        if ($user != null) {
            $check = VoteUserCautraloi::where('user_id', $user->id)->where('cau_tra_loi_id', $id)->get();
            if (count($check) == 1) {
                VoteUserCautraloi::where('cau_tra_loi_id',$id)->delete();
                return response()->json([
                    'message' => 'Bỏ Vote thành công',
                    'code' => 200,
                    'data' => [$user->id, $id]
                ], 200);
            }
        }else {
            return response()->json([
                'message' => 'Không thể bỏ vote',
                'code' => 500,
                'data' => ''
            ], 500);
        }
    }
    public function getUserVote($id){
        $data =  VoteUserCautraloi::where('cau_hoi_id', $id)->with('user')->get();
        return response()->json([
            'code' => 200,
            'message'=> 'Lấy dữ liệu thành công',
            'data'=> $data
        ],200);
    }
}
