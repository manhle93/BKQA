<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Route::get('/canhan', 'HomeController@index')->name('canhan');

Auth::routes();

Route::get('/canhan', 'LayoutController@thongTinCaNhan')->name('canhan');
Route::get ('dsthanhvien', 'UserController@index');
Route::get('/', 'ChuDeController@index');
Route::get('cauhoimoi', 'CauHoiController@cauHoiMoi');
Route::get('taikhoan/{id}', 'LayoutController@thongTinTaiKhoan');
Route::post('uploadavatar', 'LayoutController@uploadAvatar');


Route::get('timkiem/{data}', 'LayoutController@timKiem');
Route::get('timkiemnangcao', 'LayoutController@formTimKiemNangCao');
Route::post('xulytimkiemnangcao', 'LayoutController@timKiemNangCao');
Route::get('kiemtradangnhap', 'LayoutController@kiemtraDangNhap');

Route::get('cauhoitheotaikhoan/{id}', 'CauHoiController@cauHoiTheoTaiKhoan');
Route::get('nhapcauhoi', 'CauHoiController@showFormAdd');
Route::post('nhapcauhoi', 'CauHoiController@add');
Route::delete('xoacauhoi/{id}', 'CauHoiController@xoaCauHoi');

Route::delete('xoachude/{id}', 'ChuDeController@delete');
Route::post('themchude', 'ChuDeController@add');
Route::post('suachude/{id}', 'ChuDeController@edit');
Route::get('getchude', 'ChuDeController@getChuDe');
Route::get('tatcacauhoi', 'CauHoiController@index');
Route::get('cauhoichude/{id}', 'ChuDeController@cauHoiThuocChuDe');

Route::get('binhluan/{id}', 'CauHoiController@show');
Route::post('binhluan/{id}', 'CauTraLoiController@add');
Route::get('cautraloi/{id}', 'CauTraLoiController@layCauTraLoi');
Route::delete('xoacautraloi/{id}', 'CauTraLoiController@xoaCauTraLoi');

Route::post('vote/{id}', 'VoteController@addVote');
Route::delete('unvote/{id}', 'VoteController@unVote');
Route::get('uservote/{id}', 'VoteController@getUserVote');

Route::get('cauhoichoduyet', 'CauHoiController@cauHoiChoDuyet');
Route::post('pheduyetcauhoi/{id}', 'CauHoiController@pheDuyet');
Route::post('thaydoiquyen/{id}', 'UserController@setQuyen');
Route::get('getquyen', 'LayoutController@getQuyen');
Route::get('thongbao', 'LayoutController@getThongBao');
Route::post('docthongbao', 'UserController@docThongBao');
Route::get('baocaovipham', 'CauTraLoiController@danhSachBaoCao');
Route::post('baocaovipham', 'CauTraLoiController@baoCaoViPham');
Route::delete('boquacautraloivipham/{id}', 'CauTraLoiController@boQuaCauTraLoiViPham');
Route::delete('boquacauhoivipham/{id}', 'CauTraLoiController@boQuaCauHoiViPham');
Route::get('lichsu', 'LayoutController@getLichSuHoatDong');
Route::post('guithu', 'LayoutController@guiThu');
Route::get('getthu', 'LayoutController@getThu');













