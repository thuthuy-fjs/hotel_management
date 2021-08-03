@extends('frontend.layouts.sidebar')
@section('title')
    Tài khoản của bạn
@endsection
@section('content')
    <div class="container-fluid mt--6">
        <form action="{{ route('profile.update') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-xl-12 order-xl-1">
                    <div class="card">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h4>Thông tin của bạn </h4>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="container">
                                <div class="row">
                                    <div class="col-sm-8">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="input-username">Tên đăng
                                                        nhập*</label>
                                                    <input type="text" id="user_name" name="user_name"
                                                           class="form-control"
                                                           placeholder="Nhập tên đăng nhập"
                                                           value="{{$guest->user_name}}"
                                                           readonly>
                                                    @error('user_name')
                                                    <span class="small text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="input-email">Email*</label>
                                                    <input type="email" id="email" name="email" class="form-control"
                                                           placeholder="Nhập email" value="{{$guest->email}}" readonly>
                                                    <input type="password" id="password" name="password"
                                                           value="{{$guest->password}}" hidden>
                                                    @error('email')
                                                    <span class="small text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="input-first-name">Họ
                                                        đệm</label>
                                                    <input type="text" id="first_name" name="first_name"
                                                           class="form-control"
                                                           placeholder="Nhập họ đệm" value="{{$guest->first_name}}">
                                                    @error('first_name')
                                                    <span class="small text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="input-last-name">Tên</label>
                                                    <input type="text" id="last_name" name="last_name"
                                                           class="form-control"
                                                           placeholder="Nhập tên" value="{{$guest->last_name}}">
                                                    @error('last_name')
                                                    <span class="small text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="input-address">Địa
                                                        chỉ</label>
                                                    <input id="address" name="address" class="form-control"
                                                           placeholder="Nhập địa chỉ"
                                                           value="{{$guest->address}}" type="text">
                                                    @error('address')
                                                    <span class="small text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="input-city">Điện
                                                        thoại</label>
                                                    <input type="text" id="phone" name="phone" class="form-control"
                                                           placeholder="Nhập số điện thoại"
                                                           pattern="09|03|07|08|05)+([0-9]{8}"
                                                           value="{{$guest->phone}}">
                                                    @error('phone')
                                                    <span class="small text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="profile-img">
                                            <img src="{{ isset($guest->image) ? 'uploads/'. $guest->image: asset('images/admin.jpg')}}"
                                                 id="show" alt="Image" style="width: 80%; max-height: 300px"/>
                                            <div class="file btn btn-lg btn-primary">
                                                Chọn ảnh
                                                <input name="image" type="file" id="user_image" accept="image/*">
                                                <input id="image" name="image" class="form-control"
                                                       value="{{$guest->image}}" type="text" hidden>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <input type="submit" class="btn btn-primary btn-lg" value="Lưu">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <style>
        .profile-img {
            text-align: center;
        }

        .profile-img img {
            width: 100%;
            max-height: 20%;
        }

        .profile-img .file {
            position: relative;
            overflow: hidden;
            margin-top: -20%;
            width: 70%;
            border: none;
            border-radius: 0;
            font-size: 15px;
            background: #212529b8;
        }

        .profile-img .file input {
            position: absolute;
            opacity: 0;
            right: 0;
            top: 0;
        }
    </style>
@endsection
@section('js')
    <script>
        $(document).ready(function () {
            $("#image").fileinput({
                browseClass: "btn btn-primary btn-block",
                showCaption: false,
                showRemove: false,
                showUpload: false
            });
        });

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#show').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]); // convert to base64 string
            }
        }

        $("#user_image").change(function () {
            readURL(this);
        });
    </script>

@endsection
