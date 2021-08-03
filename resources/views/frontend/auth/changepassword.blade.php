@extends('frontend.layouts.sidebar')
@section('title')
    Đổi mật khẩu
@endsection
@section('content')
    <div class="container-fluid mt--6">
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('change_password.update') }}" method="post">
                            @csrf
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-2"></div>
                                    <div class="col-lg-8">
                                        <div class="form-group">
                                            <label class="col-form-label form-control-label">Mật khẩu hiện
                                                tại*</label>
                                            <input class="form-control" placeholder="Nhập mật khẩu hiện tại"
                                                   type="password"
                                                   name="current_password" id="current_password">
                                            @error('current_password')
                                            <span class="small text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-2"></div>
                                    <div class="col-lg-8">
                                        <div class="form-group">
                                            <label class="col-form-label form-control-label">Mật khẩu mới*</label>
                                            <input class="form-control" placeholder="Nhập mật khẩu mới" type="password"
                                                   name="new_password" id="new_password">
                                            @error('new_password')
                                            <span class="small text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-2"></div>
                                    <div class="col-lg-8">
                                        <div class="form-group">
                                            <label class="col-form-label form-control-label">Nhập lại mật khẩu mới*</label>
                                            <input class="form-control" placeholder="Nhập lại mật khẩu mới"
                                                   type="password"
                                                   name="confirm_password" id="confirm_password">
                                            @error('confirm_password')
                                            <span class="small text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-11 text-right">
                                    <div class="form-group">
                                        <input type="submit" class="btn btn-primary" value="Đổi mật khẩu">
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
@section('js')
@endsection
