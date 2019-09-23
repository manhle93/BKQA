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
Route::get('/', 'ChuDeController@index');
Route::get('cauhoimoi', 'CauHoiController@cauHoiMoi');

Route::get('timkiem/{data}', 'LayoutController@timKiem');
Route::get('kiemtradangnhap', 'LayoutController@kiemtraDangNhap');


Route::get('nhapcauhoi', 'CauHoiController@showFormAdd');
Route::post('nhapcauhoi', 'CauHoiController@add');

Route::get('tatcacauhoi', 'CauHoiController@index');
Route::get('cauhoichude/{id}', 'ChuDeController@cauHoiThuocChuDe');

Route::get('binhluan/{id}', 'CauHoiController@show');
Route::post('binhluan/{id}', 'CauTraLoiController@add');

