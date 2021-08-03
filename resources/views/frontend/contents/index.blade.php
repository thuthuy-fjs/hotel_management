@extends('frontend.layouts.sidebar')
@section('title')
    Đơn đặt phòng
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
                    <li class="nav-item">
                        <a href="" data-target="#bookingDetail" data-toggle="tab" class="nav-link">Phòng đã đặt</a>
                    </li>
                    <li class="nav-item">
                        <a href="" data-target="#starBooking" data-toggle="tab" class="nav-link">Đánh giá</a>
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
                        <form action="{{ route('change_password.update') }}" method="post">
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
                        <form action="{{ route('profile.update') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label">Tên đăng nhập</label>
                                <div class="col-lg-9">
                                    <input class="form-control" type="text" name="user_name" id="user_name"
                                           value="{{$guest->user_name}}">
                                    <input class="form-control" type="password" name="password"
                                           value="{{$guest->password}}" hidden>
                                </div>
                                @error('user_name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label">Email</label>
                                <div class="col-lg-9">
                                    <input class="form-control" type="email" name="email" id="email"
                                           value="{{$guest->email}}">
                                </div>
                                @error('email')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label">Họ đệm</label>
                                <div class="col-lg-9">
                                    <input class="form-control" type="text" name="first_name" id="first_name"
                                           value="{{$guest->first_name}}">
                                </div>
                                @error('first_name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label">Tên</label>
                                <div class="col-lg-9">
                                    <input class="form-control" type="text" name="last_name" id="last_name"
                                           value="{{$guest->last_name}}">
                                </div>
                                @error('last_name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label">Địa chỉ</label>
                                <div class="col-lg-9">
                                    <input class="form-control" type="text" name="address" id="address"
                                           value="{{$guest->address}}">
                                </div>
                                @error('address')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label">Điện thoại</label>
                                <div class="col-lg-9">
                                    <input class="form-control" type="text" name="phone" id="phone"
                                           value="{{$guest->phone}}" pattern="09|03|07|08|05)+([0-9]{8}">
                                </div>
                                @error('phone')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label">Ảnh</label>
                                <div class="col-lg-9">
                                    <input id="image" name="image" class="form-control"
                                           value="{{$guest->image}}" type="text" hidden>
                                    <input name="image" type="file">
                                </div>
                                @error('file')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label"></label>
                                <div class="col-lg-9">
                                    <input type="submit" class="btn btn-primary" value="Save Changes">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane" id="bookingDetail">

                        <table class="table table-border">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Khách sạn</th>
                                <th>Phòng</th>
                                <th>Ngày đặt</th>
                                <th>Đánh giá</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($guest->bookings as $booking)
                                @foreach($guest->star_rating as $star_rating)
                                    <tr>
                                        <td>{{$booking->id}}</td>
                                        <td>{{$booking->room->hotel->hotel_name}}</td>
                                        <td>{{$booking->room->room_name}}</td>
                                        <td>{{\Carbon\Carbon::parse($booking->booking_date)->format('d-m-Y')}}</td>
                                        <td>
                                            @if($star_rating->id != $booking->id)
                                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                                        data-target="#modal{{$booking->id}}">
                                                    Đánh giá
                                                </button>
                                            @else
                                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                                        data-target="#modal{{$booking->id}}" disabled>
                                                    Đã đánh giá
                                                </button>
                                            @endif

                                        </td>
                                    </tr>
                                    <div class="modal fade" id="modal{{$booking->id}}" tabindex="-1" role="dialog"
                                         aria-labelledby="modal{{$booking->id}}Label" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <form action="{{route('comment')}}">
                                                    <div class="card">
                                                        <div class="row">
                                                            <div class="col-2"><img src="{{asset('images/user.png')}}"
                                                                                    width="70"
                                                                                    class="rounded-circle mt-2"></div>
                                                            <div class="col-10">
                                                                <div class="comment-box ml-2">
                                                                    <h4>Đánh giá</h4>
                                                                    <input name="guest_id"
                                                                           value="{{$booking->guest_id}}"
                                                                           hidden>
                                                                    <input name="booking_id" value="{{$booking->id}}"
                                                                           hidden>
                                                                    <input hidden>
                                                                    <div class="rating">
                                                                        <input type="radio" name="level[]" value="5"
                                                                               id="5">
                                                                        <label for="5">☆</label>
                                                                        <input type="radio" name="level[]" value="4"
                                                                               id="4">
                                                                        <label for="4">☆</label>
                                                                        <input type="radio" name="level[]" value="3"
                                                                               id="3">
                                                                        <label for="3">☆</label>
                                                                        <input type="radio" name="level[]" value="2"
                                                                               id="2">
                                                                        <label for="2">☆</label>
                                                                        <input type="radio" name="level[]" value="1"
                                                                               id="1">
                                                                        <label for="1">☆</label>
                                                                    </div>
                                                                    <div class="comment-area">
                                                        <textarea class="form-control" name="description"
                                                                  id="description" placeholder="what is your view?"
                                                                  rows="4"></textarea>
                                                                    </div>
                                                                    <div class="comment-btns mt-2">
                                                                        <div class="row">
                                                                            <div class="col-6">
                                                                                <div class="pull-left">
                                                                                    <button class="btn btn-success btn-sm"
                                                                                            type="button" class="close"
                                                                                            data-dismiss="modal"
                                                                                            aria-label="Close">
                                                                                        Cancle
                                                                                    </button>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-6">
                                                                                <div class="pull-right">
                                                                                    <button class="btn btn-success send btn-sm"
                                                                                            type="submit">Gửi
                                                                                        <i class="fa fa-long-arrow-right ml-1"></i>
                                                                                    </button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="tab-pane" id="starBooking">
                        <table class="table table-border">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Khách sạn</th>
                                <th>Phòng</th>
                                <th>Đánh giá</th>
                                <th>Mô tả</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($guest->star_rating as $star_rating)
                                <tr>
                                    <td>{{$star_rating->id}}</td>
                                    <td>{{$star_rating->booking->room->hotel->hotel_name}}</td>
                                    <td>{{$star_rating->booking->room->room_name}}</td>
                                    <td>
                                        <div>
                                            <p class="text-left">
                                                @for($i = 1; $i < 6; $i++)
                                                    @if($i <= $star_rating->level)
                                                        <span class="fa fa-star star-active"></span>
                                                    @else
                                                        <span class="fa fa-star star-inactive"></span>
                                                    @endif
                                                @endfor
                                            </p>
                                        </div>
                                    </td>
                                    <td>
                                        {{$star_rating->description}}
                                    </td>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
            <div class="col-lg-4 order-lg-1 text-center">
                <img src="{{isset($guest->image) ? 'uploads/'.$guest->image : '//placehold.it/150'}}"
                     class="mx-auto img-fluid img-circle d-block" alt="avatar" style="height: 150px; width: 150px">
            </div>
        </div>
    </div>
    <style>
        .card {
            position: relative;
            display: flex;
            flex-direction: column;
            min-width: 0;
            padding: 20px;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border-radius: 6px;
            -moz-box-shadow: 0px 0px 5px 0px rgba(212, 182, 212, 1)
        }

        .comment-box {
            padding: 5px
        }

        .comment-area textarea {
            resize: none;
            border: 1px solid #ad9f9f
        }

        .form-control:focus {
            color: #495057;
            background-color: #fff;
            border-color: #ffffff;
            outline: 0;
            box-shadow: 0 0 0 1px rgb(255, 0, 0) !important
        }

        .send {
            color: #fff;
            background-color: #ff0000;
            border-color: #ff0000
        }

        .send:hover {
            color: #fff;
            background-color: #f50202;
            border-color: #f50202
        }

        .rating {
            display: flex;
            margin-top: -10px;
            flex-direction: row-reverse;
            margin-left: -4px;
            float: left
        }

        .rating > input {
            display: none
        }

        .rating > label {
            position: relative;
            width: 19px;
            font-size: 25px;
            color: #ff0000;
            cursor: pointer
        }

        .rating > label::before {
            content: "\2605";
            position: absolute;
            opacity: 0
        }

        .rating > label:hover:before,
        .rating > label:hover ~ label:before {
            opacity: 1 !important
        }

        .rating > input:checked ~ label:before {
            opacity: 1
        }

        .rating:hover > input:checked ~ label:before {
            opacity: 0.4
        }

        a {
            text-decoration: none !important;
            color: inherit
        }

        a:hover {
            color: #455A64
        }

        .card {
            border-radius: 5px;
            background-color: #fff;
            padding-left: 60px;
            padding-right: 60px;
            margin-top: 30px;
            padding-top: 30px;
            padding-bottom: 30px
        }

        .rating-box {
            width: 130px;
            height: 130px;
            margin-right: auto;
            margin-left: auto;
            background-color: #FBC02D;
            color: #fff
        }

        .rating-label {
            font-weight: bold
        }

        .rating-bar {
            width: 300px;
            padding: 8px;
            border-radius: 5px
        }

        .bar-container {
            width: 100%;
            background-color: #f1f1f1;
            text-align: center;
            color: white;
            border-radius: 20px;
            cursor: pointer;
            margin-bottom: 5px
        }

        .bar-5 {
            width: 70%;
            height: 13px;
            background-color: #FBC02D;
            border-radius: 20px
        }

        .bar-4 {
            width: 30%;
            height: 13px;
            background-color: #FBC02D;
            border-radius: 20px
        }

        .bar-3 {
            width: 20%;
            height: 13px;
            background-color: #FBC02D;
            border-radius: 20px
        }

        .bar-2 {
            width: 10%;
            height: 13px;
            background-color: #FBC02D;
            border-radius: 20px
        }

        .bar-1 {
            width: 0%;
            height: 13px;
            background-color: #FBC02D;
            border-radius: 20px
        }

        td {
            padding-bottom: 10px
        }

        .star-active {
            color: #FBC02D;
            margin-top: 10px;
            margin-bottom: 10px
        }

        .star-active:hover {
            color: #F9A825;
            cursor: pointer
        }

        .star-inactive {
            color: #CFD8DC;
            margin-top: 10px;
            margin-bottom: 10px
        }

        .blue-text {
            color: #0091EA
        }

        .content {
            font-size: 18px
        }

        .profile-pic {
            width: 90px;
            height: 90px;
            border-radius: 100%;
            margin-right: 30px
        }

        .pic {
            width: 80px;
            height: 80px;
            margin-right: 10px
        }

        .vote {
            cursor: pointer
        }
    </style>
@endsection
@section('js')
@endsection
