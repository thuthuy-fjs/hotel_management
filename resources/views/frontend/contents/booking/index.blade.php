@extends('frontend.layouts.app')
@section('title')
    Đặt phòng
@endsection
@section('content')
    <form action="{{route('booking.store')}}" method="post">
        <div class="container">
            <div class="row" style="margin-top: 20px">
                <div class="col-lg-4">
                    <div class="form-group">
                        <h5><b>Chi tiết phòng</b></h5>
                        <table class="table table-borderless">
                            <thead>
                            <tr>
                                <th>Nhận phòng</th>
                                <th>Trả phòng</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>{{$check_in_date}}</td>
                                <td>{{$check_out_date}}</td>
                            </tr>
                            <tr>
                                <td>
                                    <small>12h00 - 14h00</small>
                                </td>
                                <td>
                                    <small>10h00 - 12h00</small>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="form-group">
                        <h5><b>Giá phòng</b></h5>
                        <table class="table table-borderless">
                            <tbody>
                            <tr>
                                <td>Tổng tiền:</td>
                                <td><span>VND</span>
                                    <p>{{$room->room_price}}</p></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="form-group">
                        <h4><b>{{$room->hotel->hotel_name}}</b></h4>
                    </div>
                    <div class="form-group">
                        <h5>Thông tin của bạn</h5>
                        <input name="guest_id" value="{{$guest->id}}" hidden>
                        <input name="room_id" value="{{$room->id}}" hidden>
                        <input name="booking_date" value="{{\Carbon\Carbon::now()->format('Y-m-d H:i:s')}}" hidden>
                        <input name="check_in_date" value="{{$check_in_date}}" hidden>
                        <input name="check_out_date" value="{{$check_out_date}}" hidden>
                        <input name="is_payment" hidden>

                        <div class="row">
                            <div class="col-lg-6">
                                <label class="" for="user_name">Họ đệm*: </label>
                                <input class="form-control" value="{{$guest->user_name}}" type="text" name="user_name"
                                       id="user_name" disabled>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <label class="" for="email">Địa chỉ email*: </label>
                                <input class="form-control" value="{{$guest->email}}" type="text" name="email"
                                       id="email" disabled>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <label class="" for="booking_note">Ghi chú*: </label>
                                <textarea class="form-control" type="text" name="booking_note" id="booking_note"
                                          cols="50" rows="5"></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <input type="submit" class="btn btn-primary" value="Đặt">
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </form>
@endsection
@section('js')
@endsection
