@extends('frontend.layouts.auth')
@section('title')
    Thay đổi mật khẩu
@endsection
@section('content')
    <div class="hero-wrap"
         style="background-image: url({{asset('frontend_assets/images/bg_2.jpg')}}); height: 1000px;max-height: 500px">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5 col-md-7">
                    <div class="card" style="margin: 100px 0px">
                        <div class="card-body px-lg-5 py-lg-5">
                            @if (session('message'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('message') }}
                                </div>
                            @else
                                <form method="POST" action="{{ route('forgot_password.update', $token)}}">
                                    @csrf
                                    <div class="form-group">
                                        <div class="input-group input-group-merge input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="bi bi-file-lock"></i></span>
                                            </div>
                                            <input class="form-control" placeholder="Nhập mật khẩu" type="password"
                                                   name="password" id="password">

                                        </div>
                                        @error('password')
                                        <span class="small text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group input-group-merge input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="bi bi-file-lock"></i></span>
                                            </div>
                                            <input class="form-control" placeholder="Nhập mật khẩu xác nhận"
                                                   type="password" name="password_confirm" id="password_confirm">

                                        </div>
                                        @error('password_confirm')
                                        <span class="small text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="text-center">
                                        <input type="submit" class="btn btn-primary mt-4" value="Đặt lại mật khẩu">
                                    </div>
                                </form>
                            @endif
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
@section('js')
@endsection
