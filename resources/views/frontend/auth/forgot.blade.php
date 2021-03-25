@extends('frontend.layouts.auth')
@section('title')
    Quên mật khẩu
@endsection
@section('content')
    <div class="hero-wrap"
         style="background-image: url({{asset('frontend_assets/images/bg_2.jpg')}});max-height: 1000px">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5 col-md-7" style="margin: 40px 0px">
                    <div class="card">
                        <div class="card-header bg-transparent pb-5">
                            <div class="text-muted text-center mt-2 mb-3">
                                <small>Đăng nhập với</small>
                            </div>
                            <div class="btn-wrapper text-center">
                                <a href="{{route('provider', 'github')}}" class="btn btn-neutral btn-icon">
                                    <span class="btn-inner--icon"><img
                                                src="{{ asset('admin_assets/img/icons/common/github.svg')}}"></span>
                                    <span class="btn-inner--text">Github</span>
                                </a>
                                <a href="{{route('provider', 'google')}}" class="btn btn-neutral btn-icon">
                                    <span class="btn-inner--icon"><img
                                                src="{{ asset('admin_assets/img/icons/common/google.svg')}}"></span>
                                    <span class="btn-inner--text">Google</span>
                                </a>
                            </div>
                        </div>
                        <div class="card-body px-lg-5 py-lg-5">
                            @if(session('message'))
                                <section class='alert alert-success'>{{session('message')}}</section>
                            @else
                                <form action="{{ route('forgot_password.sendEmail') }}" method="post">
                                    @csrf
                                    <div class="form-group mb-3">
                                        <div class="input-group input-group-merge input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                            </div>
                                            <input class="form-control" placeholder="Nhập email" type="email"
                                                   name="email"
                                                   id="email">
                                        </div>
                                        @error('email')
                                        <span class="small text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="text-center">
                                        <input type="submit" class="btn btn-primary my-4" value="Gửi">
                                    </div>
                                </form>
                            @endif
                            <div class="container">
                                <div class="row mt-3">
                                    <div class="col-6">
                                        <a href="{{route('login')}}" class="text-dark">
                                            <small>Đăng nhập</small>
                                        </a>
                                    </div>
                                    <div class="col-6 text-right">
                                        <a href="{{ route('register') }}" class="text-dark">
                                            <small>Tạo tài khoản mới</small>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
@section('js')
@endsection
