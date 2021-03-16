@extends('admin.layouts.dashboard')
@section('title')
    Chỉnh sửa tiện ích
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
                                <h3 class="mb-0">Chỉnh sửa tiện ích phòng {{$room->room_name}} </h3>
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
                        <form action="{{ route('admin.room.facility.update') }}" method="post">
                            @csrf
                            <h6 class="heading-small text-muted mb-4">Tiện ích</h6>
                            <div class="pl-lg-8">
                                <input class="form-check-input" type="text" value="{{$room->id}}"
                                       id="room_id" name="room_id" hidden>
                                @foreach($room->facilities as $facility_room)
                                    <div class="container">
                                        <div class="row par">
                                            <input value="{{$facility_room->id}}" name="id" hidden>
                                            <input class="form-check-input" type="checkbox"
                                                   value="{{$facility_room->room_facility->id}}"
                                                   id="{{$facility_room->room_facility->id}}" name="room_facility_id[]"
                                                   checked>
                                            <label class="form-check-label" for="{{$facility_room->room_facility->id}}">
                                                {{$facility_room->room_facility->facility}}
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="col-sm-12 text-right">
                                <button type="submit" class="btn btn-success">Save</button>
                            </div>
                        </form>
                    </div>
                    {{--<form action="{{ route('admin.room.facility.update') }}" method="post">--}}
                    {{--@csrf--}}
                    {{--<h6 class="heading-small text-muted mb-4">Tiện ích</h6>--}}
                    {{--<input class="form-check-input" type="text" value="{{$room->id}}"--}}
                    {{--id="room_id" name="room_id" hidden>--}}
                    {{--<div class="pl-lg-8">--}}
                    {{--@foreach($room->facilities as $facility_room)--}}
                    {{--<div class="container">--}}
                    {{--<div class="row par">--}}
                    {{--<input class="form-check-input" type="checkbox"--}}
                    {{--value="{{$facility_room->room_facility->id}}"--}}
                    {{--id="{{$facility_room->room_facility->id}}" name="room_facility_id[]"--}}
                    {{--checked>--}}
                    {{--<label class="form-check-label" for="{{$facility_room->room_facility->id}}">--}}
                    {{--{{$facility_room->room_facility->facility}}--}}
                    {{--</label>--}}
                    {{--</div>--}}
                    {{--</div>--}}
                    {{--@endforeach--}}
                    {{--@foreach($facilities as $facility)--}}
                    {{--<div class="container">--}}
                    {{--<div class="row par">--}}
                    {{--<input class="form-check-input" type="checkbox"--}}
                    {{--value="{{$facility->id}}"--}}
                    {{--id="{{$facility->id}}" name="room_facility_id[]">--}}
                    {{--<label class="form-check-label" for="{{$facility->id}}">--}}
                    {{--{{$facility->facility}}--}}
                    {{--</label>--}}
                    {{--</div>--}}
                    {{--</div>--}}
                    {{--@endforeach--}}

                    {{--<div class="col-sm-12 text-right">--}}
                    {{--<button type="submit" class="btn btn-success">Save</button>--}}
                    {{--</div>--}}
                    {{--</div>--}}
                    {{--</form>--}}
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

