@extends('admin.layouts.dashboard')
@section('title')
    Chỉnh sửa thông tin người dùng
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
                                <h3 class="mb-0">Thêm mới người dùng </h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.guest.update', $guest->id) }}" method="post">
                            @csrf
                            <h6 class="heading-small text-muted mb-4">Thông tin người dùng </h6>
                            <div class="pl-lg-4">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-email">Email*</label>
                                            <input id="email" name="email" class="form-control" placeholder="Nhập email"
                                                   type="email" value="{{$guest->email}}">
                                            @error('email')
                                            <span class="small text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-username">Tên đăng
                                                nhập*</label>
                                            <input type="text" id="user_name" name="user_name" class="form-control"
                                                   placeholder="Nhâp tên đăng nhập" value="{{$guest->user_name}}">
                                            <input type="password" id="password" name="password" class="form-control"
                                                   placeholder="Tên đăng nhập" value="{{$guest->password}}" hidden>
                                            @error('user_name')
                                            <span class="small text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-first-name">Họ đệm</label>
                                            <input type="text" id="first_name" name="first_name" class="form-control"
                                                   placeholder="Nhập họ đệm" value="{{$guest->first_name}}">
                                            @error('first_name')
                                            <span class="small text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-last-name">Tên</label>
                                            <input type="text" id="last_name" name="last_name" class="form-control"
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
                                            <label class="form-control-label" for="image">Ảnh</label>
                                            <div style="margin: 10px 0px">
                                                <span class="input-group-btn">
                                                 <a id="lfm" data-input="thumbnail" data-preview="holder"
                                                    class="btn btn-neutral lfm-btn">
                                                   <i class="fa fa-picture-o"></i> Chọn
                                                 </a>
                                               </span>
                                            </div>
                                            <input id="thumbnail" class="form-control" type="text" name="image">
                                            @error('image')
                                            <span class="small text-danger">{{ $message }}</span>
                                            @enderror
                                            <img id="holder" style="margin-top:15px;max-height:150px;max-width:150px">
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
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-city">Điện thoại</label>
                                            <input type="text" id="phone" name="phone" class="form-control"
                                                   placeholder="Nhập số điện thoại" pattern="09|03|07|08|05)+([0-9]{8}"
                                                   value="{{$guest->phone}}">
                                            @error('phone')
                                            <span class="small text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 text-right">
                                <button type="submit" class="btn btn-success">Lưu</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{ asset('/vendor/laravel-filemanager/js/stand-alone-button.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('.lfm-btn').filemanager('image', {'prefix': 'http://localhost:8080/hotel_management/public/laravel-filemanager'});
        });

    </script>

@endsection
