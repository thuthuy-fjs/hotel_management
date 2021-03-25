@extends('admin.layouts.dashboard')
@section('title')
    Đánh giá của người dùng
@endsection
@section('content')
    <div class="header bg-primary pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-9">
                    </div>
                    <div class="col-lg-3 text-right">
                        {{--<a href="{{route('admin.guest.create')}}" class="btn btn-sm btn-neutral">Thêm mới</a>--}}
                        {{--<div class="dropdown">--}}
                            {{--<button class="btn btn-neutral btn-sm dropdown-toggle" type="button"--}}
                                    {{--id="dropdownMenuButton"--}}
                                    {{--data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
                                {{--Action--}}
                            {{--</button>--}}
                            {{--<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">--}}
                                {{--<a class="dropdown-item" data-toggle="modal" data-target="#modal">Import</a>--}}
                                {{--<a class="dropdown-item" href="{{route('admin.guest.export')}}">Export</a>--}}
                            {{--</div>--}}

                            {{--<form action="{{route('admin.guest.import')}}" method="post" enctype="multipart/form-data">--}}
                                {{--@csrf--}}
                                {{--<div class="modal fade" id="modal" tabindex="-1" role="dialog"--}}
                                     {{--aria-labelledby="modalLabel" aria-hidden="true">--}}
                                    {{--<div class="modal-dialog modal-dialog-centered" role="document">--}}
                                        {{--<div class="modal-content">--}}
                                            {{--<div class="modal-header">--}}
                                                {{--<h5 class="modal-title" id="modalLabel">Upload file</h5>--}}
                                                {{--<button type="button" class="close" data-dismiss="modal"--}}
                                                        {{--aria-label="Close">--}}
                                                    {{--<span aria-hidden="true">&times;</span>--}}
                                                {{--</button>--}}
                                            {{--</div>--}}
                                            {{--<div class="modal-body">--}}
                                                {{--Chọn file:--}}
                                                {{--<input type="file" class="custom-file-input" name="select_file"--}}
                                                       {{--accept=".xlsx, .xls, .csv"/>--}}
                                            {{--</div>--}}
                                            {{--<div class="modal-footer">--}}
                                                {{--<button type="button" class="btn btn-secondary"--}}
                                                        {{--data-dismiss="modal">--}}
                                                    {{--Close--}}
                                                {{--</button>--}}
                                                {{--<button type="submit" class="btn btn-primary">Upload</button>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</form>--}}
                        {{--</div>--}}
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
                                <h3 class="mb-0">Đánh giá của người dùng</h3>
                            </div>
                        </div>
                    </div>
                    <!-- Light table -->

                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <th>Khách sạn</th>
                                <th>Phòng</th>
                                <th>Người đặt</th>
                                <th>Đánh giá</th>
                                <th>Mô tả</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody class="list">
                            @foreach($star_ratings as $star_rating)
                                <tr>
                                    <td>{{$star_rating->id}}</td>
                                    <td>{{$star_rating->booking->room->hotel->hotel_name}}</td>
                                    <td>{{$star_rating->booking->room->room_name}}</td>
                                    <td>{{$star_rating->guest->user_name}}</td>
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
                                    <td class="text-right">
                                        <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                {{--<a class="dropdown-item"--}}
                                                   {{--href="{{route('admin.guest.edit', $guest->id)}}">Edit</a>--}}
                                                <a class="dropdown-item" data-toggle="modal"
                                                   data-target="#modal{{$star_rating->id}}">Delete</a>

                                            </div>
                                        </div>

                                    </td>
                                </tr>
                                <form action="{{route('admin.star_rating.destroy', $star_rating->id)}}" method="post">
                                    @csrf
                                    <div class="modal fade" id="modal{{$star_rating->id}}" tabindex="-1" role="dialog"
                                         aria-labelledby="modal{{$star_rating->id}}Label" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modal{{$star_rating->id}}Label">Xóa đánh giá
                                                        của {{$star_rating->guest->user_name}}</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    Bạn có chắc chắn xóa đánh giá
                                                    của {{$star_rating->guest->user_name}}?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">
                                                        Close
                                                    </button>
                                                    <button type="submit" class="btn btn-primary">Xóa</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $star_ratings->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
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
    </style>
@endsection
