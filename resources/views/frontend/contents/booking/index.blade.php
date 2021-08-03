@extends('frontend.layouts.app')
@section('title')
    Đặt phòng
@endsection
@section('content')

    <form action="{{route('booking.store')}}" method="post">
        @csrf
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
                                    <p>{{$total_price}}</p></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="col-lg-8">

                    <div class="form-group">
                        <h4><b>{{$rooms[0]->hotel->hotel_name}}</b></h4>
                    </div>
                    <div class="form-group">
                        <h5>Thông tin của bạn</h5>
                        @if(Auth::check())
                            <input name="guest_id" value="{{Auth::id()}}" hidden>
                        @endif
                        @foreach($rooms as $room)
                            <input name="room_id[]" value="{{$room->id}}" hidden>
                            <input name="total_price[]" value="{{$room->room_price}}" hidden>
                            <input name="total_price[]" value="{{$room->room_price}}" hidden>
                        @endforeach
                        @foreach($number_room as $value)
                            <input name="number_room[]" value="{{$value}}" hidden>
                        @endforeach
                        <input name="hotel_name" value="{{$room->hotel->hotel_name}}" hidden>
                        <input name="total" value="{{$total_price}}" hidden>
                        <input name="check_in_date" value="{{$check_in_date}}" hidden>
                        <input name="check_out_date" value="{{$check_out_date}}" hidden>
                        <input name="is_payment" value="0" hidden>

                        <div class="row">
                            <div class="col-lg-6">
                                <label class="" for="user_name">Họ tên*: </label>
                                @if(Auth::check())
                                    <input class="form-control" value="{{Auth::user()->user_name}}" type="text"
                                           name="name" id="name">
                                @else
                                    <input class="form-control" value="" type="text" placeholder="Nhập tên người dùng"
                                           name="name" id="name">
                                @endif
                                @error('name')
                                <span class="small text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <label class="" for="email">Địa chỉ email*: </label>
                                @if(Auth::check())
                                    <input class="form-control" value="{{Auth::user()->email}}" type="text" name="email"
                                           id="email">
                                @else
                                    <input class="form-control" value="" type="text" placeholder="Nhập email"
                                           name="email" id="email">
                                @endif
                                @error('email')
                                <span class="small text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <label class="" for="booking_note">Ghi chú: </label>
                                <textarea class="form-control" type="text" name="booking_note" id="booking_note"
                                          cols="50" rows="5"></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <label class="" for="payment_method">Phương thức thanh toán*: </label>
                                <select class="form-control" name="payment_id" id="payment_id">
                                    @foreach($payments as $payment)
                                        <option value="{{$payment->id}}">{{$payment->payment_method}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12" style="margin-top: 10px">
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
