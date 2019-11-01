@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card">
                <div class="card-body">
                    <div style="text-align:center">
                        <div style="display: inline-block"><img src="https://lh3.googleusercontent.com/bLQg-t6uZqjCpXlAXItEfkfY5xKMLdt0BrygSqwIEcdPlWGsRr9v4x0kMRWM3bbzc0jqoqsxHFUL6g5G_55198jng8h1XXiMTJmnfNjCe0kBmeIkv_uuEAb62BYw5SjCtvMhQMxBbuYMmUkj2Z-B1dZqRVgQY3I54-ZChsnZN13n6fWWFcRgmBWJZuWLdG-4jT7zkf8dQcR-TkTlOB14xtaqpEgJD8lg4lf3-Cgx3dtxzqjvtR6-1mAEv4jnzdJFktYZmFH3L2Vq1b1CaEoS8Zwa5jZVBPAQH5SopAIJfl62i0FgKQ9fk3HCejXidirExhHGCkMcshTIRuEgNulP1Se8Z1u1MwnvRLL5Y045d-3l_fgqWX5uvT3ks3RfNHujKaGELTFg_W7HRaaO_8XAlcs2u0m-2fuUB8vOntkr6Xzn2_DoW0aSal2FqpDc607dAVTppbguDaFQPcjaPJ42W7bglJ2p6LM3QfeVaSDMbDpy5Kmwq871OFYWOKpftNxbvK0vvFfYieaEzZrGgr_kyPJRDrV03Ig0hh4dN7vBnKcTJj7xAbg8S-qBBI0Mr37AXlN9c5Cxerx1mF6pGfY3NUlKcsyBmshq3HECDSOYLmpTeCN4NxdJCJ6qo5TrFH-1BM7jy7c17tnFe8NE7T4J0QbGXdHOBmYYkYXo8kvLVIdUgY3EiyVZBw=w830-h414-no" style="width: 70%;"></div>
                    </div>
                    <hr>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="email" style="font-weight: bold;">{{ __('Địa chỉ email') }}</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

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
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <!-- <div class="form-group row">
                            <div class="col-md-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Ghi nhớ đăng nhập') }}
                                    </label>
                                </div>
                            </div>
                        </div> -->

                        <div class="form-group row mb-0">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary" style="width:  100%;font-weight: bold">
                                    {{ __('ĐĂNG NHẬP') }}
                                </button>
                            </div>
                            <div class="col-md-12" style="margin-top: 35px; text-align: center;">
                                <!-- @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                                @endif -->
                                <div>
                                    Bạn chưa có tài khoản ? <a style="font-weight: bold" href="{{ route('register') }}"> Đăng ký</a>
                                </div>
                            </div>
                        </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
@endsection