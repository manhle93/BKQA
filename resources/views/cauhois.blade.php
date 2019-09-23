@extends('layouts.app')

@section('content')
<tatca-cauhoi :cauhois="{{$cauHois}}" :chudes="{{$chuDes}}"></tatca-cauhoi>

@endsection