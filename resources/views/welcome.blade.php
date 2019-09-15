@extends('layouts.app')

@section('content')

<div class="banner">
    <img src="anh/banner.png" width="100%" height="500px">
</div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="title">
                <P class="mini_title">CÙNG HỌC TẬP, TRAO ĐỔI KIẾN THỨC</P>
                <h5 style="font-family: 'Open Sans';">Hệ thống chủ đề đa dạng, Được sự hỗ trợ trực tiếp từ các giảng viên Đại học Bách Khoa Hà Nội</h5>
                <div class="bar"></div>
                <div class="intro col-md-8" style="margin-bottom: 20px">
                    <p>Là một hệ thống mở cho bất cứ ai, chúng tôi giúp bạn trả lời các câu hỏi thuộc nhiều chủ đề với cộng đồng người dùng lớn. Đặc biệt được sự hỗ trợ từ các giảng viên Đại học bách khoa Hà Nội</p>
                </div>
                <div class="card-columns" style="display: inline-block;">
                    @foreach ($chuDes as $chuDe)
                    <div class="card">
                        <img src="..." class="card-img-top" alt="...">
                        <div class="card-body">
                            <h4 class="card-title" style="font-family: 'Open Sans'; font-weight:bold">{{$chuDe->tieu_de}}</h4>
                            <p class="card-text">
                                {{ Str::limit($chuDe->mo_ta, 60) }}
                            </p>
                            <p>{{$chuDe->so_cau_hoi}} Câu hỏi</p>
                        </div>
                        <a href="#" class="btn btn-success" style="margin-bottom: 20px">Xem chi tiết</a>
                    </div>
                    @endforeach
                </div>
                <div class="col-md-2" style="display: inline-block;">
                    {{$chuDes->links()}}</div>
            </div>
            <div class="title">
                <P class="mini_title">CÂU HỎI MỚI CẬP NHẬT</P>
                <div class="bar"></div>
            </div>
            <div>
                @foreach($cauHois as $cauHoi)
                <h4>{{$cauHoi->tieu_de}}</h4>
                <p>Tạo bởi: {{$cauHoi->user->name}}<span style="margin-left: 20px"> Chủ đề: {{$cauHoi->chuDe->tieu_de}}</span> <span style="margin-left: 20px"> Thời gian: {{$cauHoi->created_at}}</span></p>
                <p>{{ Str::limit($cauHoi->noi_dung, 250) }}</p>
                <hr>
                @endforeach
            </div>
            <div class="col-md-12" style="text-align:center">
                <button type="button" class="btn btn-primary" >Toàn bộ câu hỏi</button>
            </div>
        </div>
    </div>
</div>
@endsection