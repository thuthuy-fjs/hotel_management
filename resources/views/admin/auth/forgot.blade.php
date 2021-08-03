@extends('admin.layouts.admin')
@section('title')
    Reset password
@endsection
@section('content')
    <div class="container mt--8 pb-5">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-7">
                <div class="card bg-secondary border-0 mb-0">
                    <div class="card-header bg-transparent pb-5">
                        <div class="text-muted text-center"><h2>Email của bạn</h2></div>
                    </div>
                    <div class="card-body px-lg-5 py-lg-5">
                        @if(session('message'))
                            <section class='alert alert-success'>{{session('message')}}</section>
                        @endif 

                        <form action="{{route('admin.forgot_password.sendEmail')}}" method="post">
                            @csrf
                            <div class="form-group mb-3">
                                <div class="input-group input-group-merge input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                    </div>
                                    <input class="form-control" placeholder="Email" type="email" name="email"
                                           id="email">
                                </div>
                            </div>
                            <div class="text-center">
                                <input type="submit" class="btn btn-primary my-4" value="Gửi">
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
