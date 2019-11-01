@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card">
                <div class="card-body">
                <img src="https://1.bp.blogspot.com/-c9hDz_-Jh9c/XbvtBdEp_4I/AAAAAAAAADs/V97AHWrcGOUCwP__wLdDgNqW7CC2cOZUgCLcBGAsYHQ/s1600/logo.png" style="width: 100%">
                <hr>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="name" style="font-weight: bold;">{{ __('Họ tên') }}</label>

                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="email" style="font-weight: bold;">{{ __('Địa chỉ Email') }}</label>

                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12">

                                <label for="password" style="font-weight: bold;">{{ __('Mật khẩu') }}</label>

                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="password-confirm" style="font-weight: bold;">{{ __('Nhập lại Password') }}</label>

                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row" style="margin-top: 40px;">
                            <div class="col-md-8">
                                    <input type="checkbox" id="checkbox" name="checkbox" class="@error('checkbox') is-invalid @enderror" checked>
                                <label style="font-size: 18px">Tôi chấp nhận các <a href="#">điều khoản.</a>
                                    @error('checkbox')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary" style="font-size: 14px; font-weight: bold; width: 100%; height: 35px">
                                    ĐĂNG KÝ
                                </button>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection