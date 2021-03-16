@extends('admin.layouts.dashboard')
@section('title')
    Đổi mật khẩu
@endsection
@section('content')
    <!-- Header -->
    <div class="header bg-primary pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                </div>
                <!-- Card stats -->
                <span class="mask bg-gradient-default opacity-8"></span>
                <!-- Header container -->
                <div class="container-fluid d-flex align-items-center">
                </div>
            </div>
        </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col-xl-12 order-xl-2">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">Đổi mật khẩu </h3>
                            </div>
                        </div>
                    </div>
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
                    <div class="card-body">
                        <form action="{{ route('admin.change-password.update') }}" method="post">
                            @csrf
                            <div class="pl-lg-4" style="margin-left: 200px">
                                <div class="row">
                                    <div class="col-lg-8">
                                        <div class="form-group">
                                            <label class="form-control-label" for="current_password">Mật khẩu hiện
                                                tại: </label>
                                            <input class="form-control" placeholder="Current password" type="password"
                                                   name="current_password"
                                                   id="current_password">
                                            @if ($errors->has('current_password'))
                                                <span class="help-block">
                                                    <p>{{ $errors->first('current_password') }}</p>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label class="form-control-label" for="new_password">Mật khẩu mới: </label>
                                            <input class="form-control" placeholder="New password" type="password"
                                                   name="new_password"
                                                   id="new_password">
                                            @if ($errors->has('new_password'))
                                                <span class="help-block">
                                                    <p>{{ $errors->first('new_password') }}</p>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label class="form-control-label" for="confirm_password">Nhập lại mật khẩu
                                                mới: </label>
                                            <input class="form-control" placeholder="Confirm password" type="password"
                                                   name="confirm_password" id="confirm_password">

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 text-right">
                                <button type="submit" class="btn btn-success">Change password</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

