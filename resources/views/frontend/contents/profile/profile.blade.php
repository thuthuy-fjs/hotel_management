@extends('frontend.layouts.app')
@section('title')
    Tài khoản của bạn
@endsection
@section('content')
    <div class="container">
        <div class="row my-2">
            <div class="col-lg-8 order-lg-2">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a href="" data-target="#profile" data-toggle="tab" class="nav-link active">Thông tin</a>
                    </li>
                    <li class="nav-item">
                        <a href="" data-target="#edit" data-toggle="tab" class="nav-link">Edit</a>
                    </li>
                    <li class="nav-item">
                        <a href="" data-target="#changePassword" data-toggle="tab" class="nav-link">Đổi mật khẩu</a>
                    </li>
                </ul>
                <div class="tab-content py-4">
                    <div class="tab-pane active" id="profile">
                        <h5 class="mb-3">Thông tin của bạn</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <h6>Tên đăng nhập</h6>
                                <p>
                                    {{$guest->user_name}}
                                </p>
                                <h6>Tên đầy đủ</h6>
                                <p>
                                    {{$guest->first_name . ' ' . $guest->last_name}}
                                </p>
                                <h6>Email</h6>
                                <p>
                                    {{$guest->email}}
                                </p>
                            </div>
                            <div class="col-md-12">
                                <h5 class="mt-2"> Liên lạc</h5>
                                <h6>Địa chỉ</h6>
                                <p>
                                    {{$guest->address}}
                                </p>
                                <h6>Điện thoại</h6>
                                <p>
                                    {{$guest->phone}}
                                </p>
                            </div>
                        </div>
                        <!--/row-->
                    </div>
                    <div class="tab-pane" id="changePassword">
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
                        <form action="{{ route('change-password.update') }}" method="post">
                            @csrf
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label">Mật khẩu hiện tại</label>
                                <div class="col-lg-9">
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
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label">Mật khẩu mới</label>
                                <div class="col-lg-9">
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
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label">Nhập lại mật khẩu
                                    mới</label>
                                <div class="col-lg-9">
                                    <input class="form-control" placeholder="Confirm password" type="password"
                                           name="confirm_password" id="confirm_password">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label"></label>
                                <div class="col-lg-9">
                                    <input type="submit" class="btn btn-primary" value="Change password">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane" id="edit">
                        <form action="{{ route('profile.update') }}" method="post">
                            @csrf
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label">Tên đăng nhập</label>
                                <div class="col-lg-9">
                                    <input class="form-control" type="text" name="user_name" id="user_name"
                                           value="{{$guest->user_name}}">
                                    <input class="form-control" type="password" name="password"
                                           value="{{$guest->password}}" hidden>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label">Email</label>
                                <div class="col-lg-9">
                                    <input class="form-control" type="email" name="email" id="email"
                                           value="{{$guest->email}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label">Họ đệm</label>
                                <div class="col-lg-9">
                                    <input class="form-control" type="text" name="first_name" id="first_name"
                                           value="{{$guest->first_name}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label">Tên</label>
                                <div class="col-lg-9">
                                    <input class="form-control" type="text" name="last_name" id="last_name"
                                           value="{{$guest->last_name}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label">Địa chỉ</label>
                                <div class="col-lg-9">
                                    <input class="form-control" type="text" name="address" id="address"
                                           value="{{$guest->address}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label">Điện thoại</label>
                                <div class="col-lg-9">
                                    <input class="form-control" type="text" name="phone" id="phone"
                                           value="{{$guest->phone}}" pattern="09|03|07|08|05)+([0-9]{8}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label">Ảnh</label>
                                <div class="col-lg-9">
                                    <input id="image" name="image" class="form-control"
                                           value="{{$guest->image}}" type="text">
                                    <input id="image" name="image" type="file">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label"></label>
                                <div class="col-lg-9">
                                    <input type="submit" class="btn btn-primary" value="Save Changes">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 order-lg-1 text-center">
                <img src="{{isset($guest->image) ? $guest->image: '//placehold.it/150'}}"
                     class="mx-auto img-fluid img-circle d-block" alt="avatar" style="height: 150px; width: 150px">
            </div>
        </div>
    </div>
@endsection
@section('js')
@endsection
