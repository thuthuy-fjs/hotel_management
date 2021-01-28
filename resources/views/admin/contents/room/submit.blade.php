@extends('admin.layouts.dashboard')
@section('title')
    Thêm mới phòng
@endsection
@section('content')
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
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col-xl-12 order-xl-2">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">Thêm mới phòng </h3>
                            </div>
                        </div>
                    </div>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="card-body">
                        <form action="{{ route('admin.room.store') }}" method="post">
                            @csrf
                            <div class="pl-lg-4">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="hotel_id">Khách sạn</label><br>
                                            <select id="hotel_id" name="hotel_id"
                                                    class="form-control btn-sm btn-neutral">
                                                <option value="" selected disabled>Khách sạn</option>
                                                @foreach($hotels as $hotel)
                                                    <option value="{{$hotel->id}}">{{$hotel->hotel_name}}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="room_type_id">Loại phòng nghỉ</label><br>
                                            <select id="room_type_id" name="room_type_id"
                                                    class="form-control btn-sm btn-neutral">
                                                <option value="" selected disabled>Loại phòng nghỉ</option>
                                                @foreach($types as $type)
                                                    <option value="{{$type->id}}">{{$type->room_type}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="room_name">Số phòng</label>
                                            <input type="text" id="room_name" name="room_name" class="form-control"
                                                   placeholder="Room name">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="room_price">Giá tiền</label>
                                            <input type="text" id="room_price" name="room_price" class="form-control"
                                                   placeholder="Room price">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 text-center">
                                    <input type="submit" class="btn btn-success" hidden>
                                    <a href="{{route('admin.room.image.create')}}" class="btn btn-success">Next</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
