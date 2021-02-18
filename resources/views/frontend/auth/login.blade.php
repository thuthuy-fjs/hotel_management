@extends('frontend.layouts.auth')
@section('title')
    Đăng nhập
@endsection
@section('content')
    <div class="hero-wrap js-fullheight" style="background-image: url({{asset('frontend_assets/images/bg_2.jpg')}});">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5 col-md-7" style=" margin-top: 40px">
                    <div class="card">
                        <div class="card-header bg-transparent pb-5">
                            <div class="text-muted text-center mt-2 mb-3">
                                <small>Sign in with</small>
                            </div>
                            <div class="btn-wrapper text-center">
                                <a href="#" class="btn btn-neutral btn-icon">
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
                            <form action="{{ route('login.store') }}" method="post">
                                @csrf
                                <div class="form-group mb-3">
                                    <div class="input-group input-group-merge input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                        </div>
                                        <input class="form-control" placeholder="Email" type="email" name="email"
                                               id="email">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group input-group-merge input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="bi bi-file-lock"></i></span>
                                        </div>
                                        <input class="form-control" placeholder="Password" type="password"
                                               name="password" id="password">
                                    </div>
                                </div>
                                <div class="custom-control custom-control-alternative custom-checkbox">
                                    <input class="custom-control-input" id=" customCheckLogin" type="checkbox"
                                           name="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="custom-control-label" for=" customCheckLogin">
                                        <span class="text-muted">Remember me</span>
                                    </label>
                                </div>
                                <div class="text-center">
                                    <input type="submit" class="btn btn-primary my-4" value="Sign in">
                                </div>
                            </form>
                            <div class="row mt-3">
                                <div class="col-6">
                                    <a href="{{route('forgot-password.getEmail')}}" class="text-dark">
                                        <small>Forgot password?</small>
                                    </a>
                                </div>
                                <div class="col-6 text-right">
                                    <a href="{{ route('register') }}" class="text-dark">
                                        <small>Create new account</small>
                                    </a>
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
