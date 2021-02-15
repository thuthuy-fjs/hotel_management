@extends('frontend.layouts.auth')
@section('title')
    Thay đổi mật khẩu
@endsection
@section('content')
    <div class="hero-wrap js-fullheight"
         style="background-image: url({{asset('frontend_assets/images/bg_2.jpg')}}); height: 1000px">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5 col-md-7">
                    <div class="card" style="height: 95%;margin-top: 110px">
                        <div class="card-body px-lg-5 py-lg-5">
                            @if(!empty($message))
                                <section class='alert alert-success'>{{$message}}</section>
                                <a class="small" href="{{route('login')}}">Login</a>
                            @else
                                <form method="POST" action="{{ route('forgot-password.update', $token)}}">
                                    @csrf
                                    <div class="form-group">
                                        <div class="input-group input-group-merge input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="bi bi-file-lock"></i></span>
                                            </div>
                                            <input class="form-control" placeholder="Password" type="password"
                                                   name="password" id="password">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group input-group-merge input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="bi bi-file-lock"></i></span>
                                            </div>
                                            <input class="form-control" placeholder="Confirm password" type="password"
                                                   name="password_confirm" id="password_confirm">
                                        </div>
                                    </div>

                                    <div class="text-center">
                                        <input type="submit" class="btn btn-primary mt-4" value="Reset password">
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
