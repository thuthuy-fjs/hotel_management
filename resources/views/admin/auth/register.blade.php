@extends('admin.layouts.admin')
@section('title')
    Đăng kí
@endsection
@section('content')
    <div class="container mt--8 pb-5">
        <!-- Table -->
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8">
                <div class="card bg-secondary border-0">
                    <div class="card-body px-lg-5 py-lg-5">
                        <div class="text-center text-muted mb-4">
                            <h2>Đăng kí quản trị</h2>
                        </div>
                        <form method="POST" action="{{ route('admin.register.store')}}">
                            @csrf
                            <div class="form-group">
                                <div class="input-group input-group-merge input-group-alternative mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
                                    </div>
                                    <input class="form-control" placeholder="Nhập tên đăng nhập" type="text"
                                           id="user_name"
                                           name="user_name" value="{{old('user_name')}}">

                                </div>
                                @error('user_name')
                                <span class="small text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <div class="input-group input-group-merge input-group-alternative mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                    </div>
                                    <input class="form-control" placeholder="Nhập email" type="email" id="email"
                                           name="email" value="{{old('email')}}">

                                </div>
                                @error('email')
                                <span class="small text-danger">{{ $message }}</span>
                                @enderror

                            </div>
                            <div class="form-group">
                                <div class="input-group input-group-merge input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
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
                                        <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                    </div>
                                    <input class="form-control" placeholder="Mật khẩu xác nhận" type="password"
                                           name="password_confirm" id="password_confirm">
                                </div>
                                @error('password_confirm')
                                <span class="small text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="text-center">
                                <input type="submit" class="btn btn-primary mt-4" value="Tạo tài khoản">
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-6">
                        <a href="{{route('admin.forgot_password.getEmail')}}" class="text-light">
                            <small>Quên mật khẩu</small>
                        </a>
                    </div>
                    <div class="col-6 text-right">
                        <a href="{{ route('admin.register') }}" class="text-light">
                            <small>Tạo tài khoản mới</small>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
