@extends('admin.layouts.dashboard')
@section('title')
    Chỉnh sửa thông tin
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
                                <h3 class="mb-0">Chỉnh sửa thông tin của {{$admin->user_name}} </h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.profile.update') }}" method="post">
                            @csrf
                            <h6 class="heading-small text-muted mb-4">Thông tin</h6>
                            <div class="pl-lg-4">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-username">Username</label>
                                            <input type="text" id="user_name" name="user_name" class="form-control"
                                                   placeholder="Username" value="{{$admin->user_name}}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-email">Email</label>
                                            <input type="email" id="email" name="email" class="form-control"
                                                   placeholder="Email" value="{{$admin->email}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-first-name">Họ đệm</label>
                                            <input type="text" id="first_name" name="first_name" class="form-control"
                                                   placeholder="First name" value="{{$admin->first_name}}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-last-name">Tên</label>
                                            <input type="text" id="last_name" name="last_name" class="form-control"
                                                   placeholder="Last name" value="{{$admin->last_name}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-address">Ảnh</label>
                                            <input id="image" name="image" class="form-control" placeholder="Address"
                                                   value="{{$admin->location}}" type="text">
                                            <input id="password" name="password" class="form-control" placeholder=""
                                                   value="{{$admin->password}}" type="password" hidden>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="my-4"/>
                            <!-- Address -->
                            <h6 class="heading-small text-muted mb-4">Liên lạc</h6>
                            <div class="pl-lg-4">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-address">Địa chỉ</label>
                                            <input id="location" name="location" class="form-control" placeholder="Address"
                                                   value="{{$admin->location}}" type="text">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-city">Điện thoại</label>
                                            <input type="text" id="phone" name="phone" class="form-control" placeholder="Phone" pattern="09|03|07|08|05)+([0-9]{8}"
                                                   value="{{$admin->phone}}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-offset-2">
                                <button type="submit" class="btn btn-success">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
