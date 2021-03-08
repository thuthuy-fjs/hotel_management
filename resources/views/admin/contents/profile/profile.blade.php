@extends('admin.layouts.dashboard')
@section('title')
    Profile
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
                    <div class="row">
                        <div class="col-lg-7 col-md-10">
                            <h1 class="display-2 text-white">Hello {{$admin->user_name}}</h1>
                            <p class="text-white mt-0 mb-5">This is your profile page. You can see the progress you've
                                made with your work and manage your projects or assigned tasks</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col-xl-4 order-xl-2">
                <div class="card card-profile">
                    <img src="{{ asset('admin_assets/img/theme/img-1-1000x600.jpg')}}" alt="Image placeholder"
                         class="card-img-top">
                    <div class="row justify-content-center">
                        <div class="col-lg-3 order-lg-2">
                            <div class="card-profile-image">
                                <a href="#">
                                    <img src="{{ isset($admin->image) ? $admin->image: asset('admin_assets/img/theme/admin.jpg')}}"
                                         class="rounded-circle">
                                </a>
                            </div>

                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <div class="text-center" style="margin-top: 80px">
                            <h5 class="h3">{{ $admin->first_name . ' ' . $admin->last_name}}</span>
                            </h5>
                            <div class="h5 font-weight-300">
                                <i class="ni location_pin mr-2"></i>{{$admin->location}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-8 order-xl-1">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">Thông tin của bạn </h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{route('admin.profile.edit')}}" class="btn btn-sm btn-primary">Edit</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form>
                            <h6 class="heading-small text-muted mb-4">Thông tin</h6>
                            <div class="pl-lg-4">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-username">Tên đăng nhập</label>
                                            <input type="text" id="input-username" class="form-control"
                                                   placeholder="Tên đăng nhập" value="{{$admin->user_name}}" disabled>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-email">Email</label>
                                            <input type="email" id="input-email" class="form-control"
                                                   placeholder="Email" value="{{$admin->email}}" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-first-name">Họ đệm</label>
                                            <input type="text" id="input-first-name" class="form-control"
                                                   placeholder="First name" value="{{$admin->first_name}}" disabled>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-last-name">Tên</label>
                                            <input type="text" id="input-last-name" class="form-control"
                                                   placeholder="Last name" value="{{$admin->last_name}}" disabled>
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
                                            <input id="input-address" class="form-control" placeholder="Address"
                                                   value="{{$admin->location}}" type="text" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-city">Điện thoại</label>
                                            <input type="text" id="input-city" class="form-control" placeholder="Phone"
                                                   value="{{$admin->phone}}" disabled>
                                        </div>
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
