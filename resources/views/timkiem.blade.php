@extends('layouts.app')

@section('content')
<ketqua-timkiem :tukhoa="{{JSON_encode($tukhoa)}}" :ketqua="{{$ketqua}}" ></ketqua-timkiem>
@endsection