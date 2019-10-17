@extends('layouts.app')

@section('content')
<thongtin-taikhoan :user="{{$user}}"></thongtin-taikhoan>
@endsection