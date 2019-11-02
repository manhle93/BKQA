@extends('layouts.app')

@section('content')
<nhap-cauhoi :chudes="{{$chude}}" :user="{{$user}}"></nhap-cauhoi>
@endsection