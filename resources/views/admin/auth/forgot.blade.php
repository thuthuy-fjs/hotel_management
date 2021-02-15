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
                        <div class="text-muted text-center mt-2 mb-4"><small>Sign up with</small></div>
                        <div class="text-center">
                            <a href="#" class="btn btn-neutral btn-icon mr-4">
                                <span class="btn-inner--icon"><img src="{{ asset('admin_assets/img/icons/common/github.svg')}}"></span>
                                <span class="btn-inner--text">Github</span>
                            </a>
                            <a href="#" class="btn btn-neutral btn-icon">
                                <span class="btn-inner--icon"><img src="{{ asset('admin_assets/img/icons/common/google.svg')}}"></span>
                                <span class="btn-inner--text">Google</span>
                            </a>
                        </div>
                    </div>
                    <div class="card-body px-lg-5 py-lg-5">
                        @if(session('message'))
                            <section class='alert alert-success'>{{session('message')}}</section>
                        @endif 

                        <form action="{{route('admin.forgot-password.sendEmail')}}" method="post">
                            @csrf
                            <div class="form-group mb-3">
                                <div class="input-group input-group-merge input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                    </div>
                                    <input class="form-control" placeholder="Email" type="email" name="email" id="email">
                                </div>
                            </div>
                            <div class="text-center">
                                <input type="submit" class="btn btn-primary my-4" value="Send">
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-6">
                        <a href="{{route('admin.auth.login')}}" class="text-light"><small>Login</small></a>
                    </div>
                    <div class="col-6 text-right">
                        <a href="{{ route('admin.register') }}" class="text-light"><small>Create new account</small></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
