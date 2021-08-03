@extends('admin.layouts.dashboard')
@section('title')
    Danh sách phòng đã được đặt
@endsection
@section('content')
    <div class="header bg-primary pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-9">
                    </div>
                    <div class="col-lg-3 text-right">
                        <a href="" class="btn btn-sm btn-neutral">Thêm mới</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col">
                <div class="card">
                    <!-- Card header -->
                    <div class="card-header border-0">
                        <div class="row">
                            <div class="col-lg-7">
                                <h3 class="mb-0">Danh sách phòng</h3>
                            </div>
                        </div>
                    </div>
                    <!-- Light table -->

                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col">Người dùng</th>
                                <th scope="col">Khách sạn</th>
                                <th scope="col">Loại phòng</th>
                                <th scope="col">Ngày nhận phòng</th>
                                <th scope="col">Ngày trả phòng</th>
                                <th scope="col">Ghi chú</th>
                                {{--<th scope="col"></th>--}}
                            </tr>
                            </thead>
                            <tbody class="list">
                            @foreach($bookings as $booking)
                                <tr>
                                    <td>
                                        {{$booking->name}}
                                    </td>
                                    <td>
                                        {{$booking->room->hotel->hotel_name}}
                                    </td>
                                    <td>
                                        {{$booking->room->type->room_type}}
                                    </td>
                                    <td>
                                        {{\Carbon\Carbon::parse($booking->check_in_date)->format('d-m-Y')}}
                                    </td>
                                    <td>
                                        {{\Carbon\Carbon::parse($booking->check_out_date)->format('d-m-Y')}}
                                    </td>
                                    <td>
                                        {{$booking->booking_note}}
                                    </td>

                                    {{--<td class="text-right">--}}
                                        {{--<div class="dropdown">--}}
                                            {{--<a class="btn btn-sm btn-icon-only text-light" href="#" role="button"--}}
                                               {{--data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
                                                {{--<i class="fas fa-ellipsis-v"></i>--}}
                                            {{--</a>--}}
                                            {{--<div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">--}}
                                                {{--<a class="dropdown-item"--}}
                                                   {{--href="{{route('admin.booking.edit', $booking->id)}}">Edit</a>--}}
                                                {{--<a class="dropdown-item" data-toggle="modal"--}}
                                                   {{--data-target="#modal{{$booking->id}}">Delete</a>--}}

                                            {{--</div>--}}
                                        {{--</div>--}}

                                    </td>
                                </tr>
                                {{--<form action="{{route('admin.booking.destroy', $booking->id)}}" method="post">--}}
                                    {{--@csrf--}}
                                    {{--<div class="modal fade" id="modal{{$booking->id}}" tabindex="-1" role="dialog"--}}
                                         {{--aria-labelledby="modal{{$booking->id}}Label" aria-hidden="true">--}}
                                        {{--<div class="modal-dialog modal-dialog-centered" role="document">--}}
                                            {{--<div class="modal-content">--}}
                                                {{--<div class="modal-header">--}}
                                                    {{--<h5 class="modal-title" id="modal{{$booking->id}}Label">Xóa người dùng{{$booking->user_name}}</h5>--}}
                                                    {{--<button type="button" class="close" data-dismiss="modal"--}}
                                                            {{--aria-label="Close">--}}
                                                        {{--<span aria-hidden="true">&times;</span>--}}
                                                    {{--</button>--}}
                                                {{--</div>--}}
                                                {{--<div class="modal-body">--}}
                                                    {{--Bạn có chắc chắn xóa người dùng {{$booking->user_name}}?--}}
                                                {{--</div>--}}
                                                {{--<div class="modal-footer">--}}
                                                    {{--<button type="button" class="btn btn-secondary"--}}
                                                            {{--data-dismiss="modal">--}}
                                                        {{--Close--}}
                                                    {{--</button>--}}
                                                    {{--<button type="submit" class="btn btn-primary">Xóa</button>--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</form>--}}
                            @endforeach
                            </tbody>
                        </table>
                        {{ $bookings->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
