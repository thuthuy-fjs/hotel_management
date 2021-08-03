@extends('frontend.layouts.sidebar')
@section('title')
    Đơn đặt phòng
@endsection
@section('content')
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card">
                    <div class="card-body">
                        <div class="col-lg-12">
                            <ul class="nav nav-tabs">
                                <li class="nav-item">
                                    <a href="" data-target="#all-booking" data-toggle="tab"
                                       class="nav-link active">Tất cả</a>
                                </li>
                                <li class="nav-item">
                                    <a href="" data-target="#incomplete-booking" data-toggle="tab"
                                       class="nav-link">Đơn chưa hoàn thành</a>
                                </li>
                                <li class="nav-item">
                                    <a href="" data-target="#complete-booking" data-toggle="tab"
                                       class="nav-link">Đơn đã hoàn thành</a>
                                </li>

                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="all-booking">
                                    @if(count($bookings) > 0)
                                        <table class="table table-border">
                                            <thead>
                                            <tr>
                                                <th>Khách sạn</th>
                                                <th>Loại phòng</th>
                                                <th>Số lượng</th>
                                                <th>Thanh toán</th>
                                                <th>Trạng thái</th>
                                                <th>Đánh giá</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($bookings as $booking)
                                                <tr>
                                                    <td><a href="#">{{$booking->room->hotel->hotel_name}}</a></td>
                                                    <td>{{$booking->room->type->room_type}}</td>
                                                    <td>{{$booking->number_room}}</td>
                                                    <td>{{$booking->payment->payment_method}}</td>

                                                    @if(\Carbon\Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d') >
                                                    (\Carbon\Carbon::parse($booking->check_out_date)->format('Y-m-d')))
                                                        <td>Đã hoàn thành</td>
                                                    @else
                                                        <td>Chưa hoàn thành</td>
                                                    @endif
                                                    @if(\Carbon\Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d') >
                                                   (\Carbon\Carbon::parse($booking->check_out_date)->format('Y-m-d')))
                                                        @foreach($star_ratings as $star_rating)
                                                            @if($star_rating->booking_id == $booking->id)
                                                                <td>
                                                                    <button type="button" class="btn btn-primary"
                                                                            data-toggle="modal"
                                                                            data-target="#modal{{$booking->id}}"
                                                                            disabled>
                                                                        Đã đánh giá
                                                                    </button>
                                                                </td>
                                                            @else
                                                                <td>
                                                                    <button type="button" class="btn btn-primary"
                                                                            data-toggle="modal"
                                                                            data-target="#modal{{$booking->id}}">
                                                                        Đánh giá
                                                                    </button>
                                                                </td>
                                                            @endif
                                                        @endforeach

                                                    @endif
                                                </tr>
                                                <div class="modal fade" id="modal{{$booking->id}}" tabindex="-1"
                                                     role="dialog"
                                                     aria-labelledby="modal{{$booking->id}}Label" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <form action="{{route('comment')}}">
                                                                <div class="cart-star">
                                                                    <div class="row">
                                                                        <div class="col-2"><img
                                                                                    src="{{asset('images/user.png')}}"
                                                                                    width="70"
                                                                                    class="rounded-circle mt-2"></div>
                                                                        <div class="col-10">
                                                                            <div class="comment-box ml-2">
                                                                                <h4>Đánh giá</h4>
                                                                                <input name="guest_id"
                                                                                       value="{{$booking->guest_id}}"
                                                                                       hidden>
                                                                                <input name="booking_id"
                                                                                       value="{{$booking->id}}"
                                                                                       hidden>
                                                                                <input hidden>
                                                                                <div class="rating">
                                                                                    <input type="radio" name="level[]"
                                                                                           value="5"
                                                                                           id="5">
                                                                                    <label for="5">☆</label>
                                                                                    <input type="radio" name="level[]"
                                                                                           value="4"
                                                                                           id="4">
                                                                                    <label for="4">☆</label>
                                                                                    <input type="radio" name="level[]"
                                                                                           value="3"
                                                                                           id="3">
                                                                                    <label for="3">☆</label>
                                                                                    <input type="radio" name="level[]"
                                                                                           value="2"
                                                                                           id="2">
                                                                                    <label for="2">☆</label>
                                                                                    <input type="radio" name="level[]"
                                                                                           value="1"
                                                                                           id="1">
                                                                                    <label for="1">☆</label>
                                                                                </div>
                                                                                <div class="comment-area">
                                                        <textarea class="form-control" name="description"
                                                                  id="description" placeholder="Đánh giá của bạn"
                                                                  rows="6" cols="200"></textarea>
                                                                                </div>
                                                                                <div class="comment-btns mt-2">
                                                                                    <div class="row">
                                                                                        <div class="col-6">
                                                                                            <div class="pull-left">
                                                                                                <button class="btn btn-success btn-sm"
                                                                                                        type="button"
                                                                                                        class="close"
                                                                                                        data-dismiss="modal"
                                                                                                        aria-label="Close">
                                                                                                    Cancle
                                                                                                </button>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-6">
                                                                                            <div class="pull-right">
                                                                                                <button class="btn btn-success send btn-sm"
                                                                                                        type="submit">
                                                                                                    Gửi
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
                                            </tbody>
                                        </table>
                                        {{$bookings->links()}}
                                    @else
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-sm-12 text-center" style="margin-top: 15px">
                                                    <section class='alert alert-success'>Bạn chưa có đơn đặt phòng nào
                                                    </section>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <div class="tab-pane" id="incomplete-booking">
                                    @if(count($incomplete_bookings) > 0)
                                        <table class="table table-border">
                                            <thead>
                                            <tr>
                                                <th>Khách sạn</th>
                                                <th>Loại phòng</th>
                                                <th>Số lượng</th>
                                                <th>Thanh toán</th>
                                                <th>Trạng thái</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($incomplete_bookings as $booking)
                                                <tr>
                                                    <td><a href="#">{{$booking->room->hotel->hotel_name}}</a></td>
                                                    <td>{{$booking->room->type->room_type}}</td>
                                                    <td>{{$booking->number_room}}</td>
                                                    <td>{{$booking->payment->payment_method}}</td>
                                                    <td>Chưa hoàn thành</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                        {{$incomplete_bookings->links()}}
                                    @else
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-sm-12 text-center" style="margin-top: 15px">
                                                    <section class='alert alert-success'>Bạn không có đơn đặt phòng chưa
                                                        hoàn thành!
                                                    </section>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <div class="tab-pane" id="complete-booking">
                                    @if(count($complete_bookings)>0)
                                        <table class="table table-border">
                                            <thead>
                                            <tr>
                                                <th>Khách sạn</th>
                                                <th>Loại phòng</th>
                                                <th>Số lượng</th>
                                                <th>Thanh toán</th>
                                                <th>Trạng thái</th>
                                                {{--<th>Đánh giá</th>--}}

                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($complete_bookings as $booking)
                                                <tr>
                                                    <td><a href="#">{{$booking->room->hotel->hotel_name}}</a></td>
                                                    <td>{{$booking->room->type->room_type}}</td>
                                                    <td>{{$booking->number_room}}</td>
                                                    <td>{{$booking->payment->payment_method}}</td>
                                                    <td>Đã hoàn thành</td>
                                                    {{--@if(count($star_ratings) > 0)--}}
                                                    {{--@foreach($star_ratings as $star_rating)--}}
                                                    {{--@if($star_rating->booking_id == $booking->id)--}}
                                                    {{--<td>--}}
                                                    {{--<button type="button" class="btn btn-primary"--}}
                                                    {{--data-toggle="modal"--}}
                                                    {{--data-target="#modal{{$booking->id}}"--}}
                                                    {{--disabled>--}}
                                                    {{--Đã đánh giá--}}
                                                    {{--</button>--}}
                                                    {{--</td>--}}
                                                    {{--@else--}}
                                                    {{--<td>--}}
                                                    {{--<button type="button" class="btn btn-primary"--}}
                                                    {{--data-toggle="modal"--}}
                                                    {{--data-target="#modal1{{$booking->id}}">--}}
                                                    {{--Đánh giá--}}
                                                    {{--</button>--}}
                                                    {{--</td>--}}
                                                    {{--@endif--}}
                                                    {{--@endforeach--}}
                                                    {{--@else--}}
                                                    {{--<td>--}}
                                                    {{--<button type="button" class="btn btn-primary"--}}
                                                    {{--data-toggle="modal"--}}
                                                    {{--data-target="#modal1{{$booking->id}}">--}}
                                                    {{--Đánh giá--}}
                                                    {{--</button>--}}
                                                    {{--</td>--}}
                                                    {{--@endif--}}
                                                </tr>
                                                <div class="modal fade" id="modal1{{$booking->id}}" tabindex="-1"
                                                     role="dialog"
                                                     aria-labelledby="modal1{{$booking->id}}Label" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <form action="{{route('comment')}}">
                                                                <div class="cart-star">
                                                                    <div class="row">
                                                                        <div class="col-2"><img
                                                                                    src="{{asset('images/user.png')}}"
                                                                                    width="70"
                                                                                    class="rounded-circle mt-2"></div>
                                                                        <div class="col-10">
                                                                            <div class="comment-box ml-2">
                                                                                <h4>Đánh giá</h4>
                                                                                <input name="guest_id"
                                                                                       value="{{$booking->guest_id}}"
                                                                                       hidden>
                                                                                <input name="booking_id"
                                                                                       value="{{$booking->id}}"
                                                                                       hidden>
                                                                                <input hidden>
                                                                                <div class="rating1">
                                                                                    <input type="radio" name="level[]"
                                                                                           value="5"
                                                                                           id="5">
                                                                                    <label for="5">☆</label>
                                                                                    <input type="radio" name="level[]"
                                                                                           value="4"
                                                                                           id="4">
                                                                                    <label for="4">☆</label>
                                                                                    <input type="radio" name="level[]"
                                                                                           value="3"
                                                                                           id="3">
                                                                                    <label for="3">☆</label>
                                                                                    <input type="radio" name="level[]"
                                                                                           value="2"
                                                                                           id="2">
                                                                                    <label for="2">☆</label>
                                                                                    <input type="radio" name="level[]"
                                                                                           value="1"
                                                                                           id="1">
                                                                                    <label for="1">☆</label>
                                                                                </div>
                                                                                <div class="comment-area">
                                                        <textarea class="form-control" name="description"
                                                                  id="description" placeholder="Đánh giá của bạn"
                                                                  rows="6" cols="200"></textarea>
                                                                                </div>
                                                                                <div class="comment-btns mt-2">
                                                                                    <div class="row">
                                                                                        <div class="col-6">
                                                                                            <div class="pull-left">
                                                                                                <button class="btn btn-success btn-sm"
                                                                                                        type="button"
                                                                                                        class="close"
                                                                                                        data-dismiss="modal"
                                                                                                        aria-label="Close">
                                                                                                    Cancle
                                                                                                </button>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-6">
                                                                                            <div class="pull-right">
                                                                                                <button class="btn btn-success send btn-sm"
                                                                                                        type="submit">
                                                                                                    Gửi
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
                                            </tbody>
                                        </table>
                                        {{$complete_bookings->links()}}
                                    @else
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-sm-12 text-center" style="margin-top: 15px">
                                                    <section class='alert alert-success'>Bạn chưa có đơn đặt phòng đã
                                                        hoàn thành!
                                                    </section>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .cart-star {
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

        .cart-star {
            border-radius: 5px;
            background-color: #fff;
            padding-left: 10px;
            padding-right: 10px;
            margin-top: 10px;
            padding-top: 10px;
            padding-bottom: 10px
        }

        .rating1 {
            display: flex;
            margin-top: -10px;
            flex-direction: row-reverse;
            margin-left: -4px;
            float: left
        }

        .rating1 > input {
            display: none
        }

        .rating1 > label {
            position: relative;
            width: 19px;
            font-size: 25px;
            color: #ff0000;
            cursor: pointer
        }

        .rating1 > label::before {
            content: "\2605";
            position: absolute;
            opacity: 0
        }

        .rating1 > label:hover:before,
        .rating1 > label:hover ~ label:before {
            opacity: 1 !important
        }

        .rating1 > input:checked ~ label:before {
            opacity: 1
        }

        .rating1:hover > input:checked ~ label:before {
            opacity: 0.4
        }
    </style>
@endsection
@section('js')
@endsection
