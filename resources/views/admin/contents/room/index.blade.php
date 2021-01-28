@extends('admin.layouts.dashboard')
@section('title')
    Danh sách phòng
@endsection
@section('content')
    <div class="header bg-primary pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">

                    <div class="col-lg-6">
                        <form action="{{route('admin.room.list_rooms')}}" method="get">
                            <select id="hotel" name="hotel" class="btn btn-sm btn-neutral">
                                <option value="" selected disabled>Khách sạn</option>
                                @foreach($hotels as $hotel)
                                    <option value="{{$hotel->id}}">{{$hotel->hotel_name}}</option>
                                @endforeach

                            </select>
                            <input type="submit" class="btn btn-sm btn-neutral" value="Tìm kiếm">
                        </form>
                    </div>
                    <div class="col-lg-6 text-right">
                        <a href="{{route('admin.room.create')}}" class="btn btn-sm btn-neutral">Thêm mới</a>
                        <div class="dropdown">
                            <button class="btn btn-neutral btn-sm dropdown-toggle" type="button"
                                    id="dropdownMenuButton"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Action
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item"  data-toggle="modal" data-target="#modal">Import</a>
                                <a class="dropdown-item" href="{{route('admin.room.export')}}">Export</a>
                            </div>

                            <form action="{{route('admin.room.import')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="modal fade" id="modal" tabindex="-1" role="dialog"
                                     aria-labelledby="modalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalLabel">Upload file</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Chọn file:
                                                <input type="file" class="custom-file-input" name="select_file" accept=".xlsx, .xls, .csv"/>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">
                                                    Close
                                                </button>
                                                <button type="submit" class="btn btn-primary">Upload</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
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
                            <div class="col-lg-5 text-right">
                                <form class="navbar-search navbar-search-light form-inline" action="{{route('admin.room.search')}}" method="GET"
                                      name="search"
                                      id="search">
                                    <div class="form-group mb-0">
                                        <div class="input-group input-group-alternative input-group-merge input-group-sm">
                                            <div class="input-group-prepend input-group-sm">
                                                <span class="input-group-text"><i class="fas fa-search"></i></span>
                                            </div>
                                            <input class="form-control" name="search" placeholder="Search" type="text">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Light table -->

                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tên khách sạn</th>
                                <th scope="col">Loại phòng nghỉ</th>
                                <th scope="col">Số phòng</th>
                                <th scope="col">Giá tiền</th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody class="list">
                            @foreach($rooms as $room)
                                <tr>
                                    <td>
                                        {{$room->id}}
                                    </td>
                                    <td>
                                        {{$room->hotel->hotel_name}}
                                    </td>

                                    <td>
                                        {{$room->roomType->room_type}}
                                    </td>
                                    <td>
                                        {{$room->room_name}}
                                    </td>
                                    <td>
                                        {{$room->room_price}}
                                    </td>

                                    <td class="text-right">
                                        <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                <a class="dropdown-item" href="{{route('admin.room.show', $room->id)}}">Show</a>
                                                <a class="dropdown-item"
                                                   href="{{route('admin.room.edit', $room->id)}}">Edit</a>
                                                <a class="dropdown-item" data-toggle="modal"
                                                   data-target="#modal{{$room->id}}">Delete</a>

                                            </div>
                                        </div>

                                    </td>
                                </tr>
                                <form action="{{route('admin.room.destroy', $room->id)}}" method="post">
                                    @csrf
                                    <div class="modal fade" id="modal{{$room->id}}" tabindex="-1" role="dialog"
                                         aria-labelledby="modal{{$room->id}}Label" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modal{{$room->id}}Label">Xóa phòng {{$room->room_name}}</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    Bạn có chắc chắn xóa phòng {{$room->room_name}} ?
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
                        {{--{{ $rooms->links() }}--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
