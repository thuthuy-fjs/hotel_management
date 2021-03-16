@extends('admin.layouts.dashboard')
@section('title')
    Loại chỗ nghỉ
@endsection
@section('content')
    <div class="header bg-primary pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                </div>
            </div>
        </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col">
                <div class="card">
                    <!-- Card header -->
                    <div class="card-header border-0">
                        <h3 class="mb-0">Loại phòng nghỉ</h3>
                    </div>
                    <!-- Light table -->
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Loại phòng nghỉ</th>
                                <th scope="col">Mô tả</th>
                                {{--<th scope="col"></th>--}}
                            </tr>
                            </thead>
                            <tbody class="list">
                            @foreach($types as $type)
                                <tr>
                                    <td>
                                        {{$type->id}}
                                    </td>
                                    <td>
                                        {{$type->room_type}}
                                    </td>

                                    <td>
                                        {{$type->description}}
                                    </td>

                                    {{--<td class="text-right">--}}
                                        {{--<div class="dropdown">--}}
                                            {{--<a class="btn btn-sm btn-icon-only text-light" href="#" role="button"--}}
                                               {{--data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
                                                {{--<i class="fas fa-ellipsis-v"></i>--}}
                                            {{--</a>--}}
                                            {{--<div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">--}}
                                                {{--<a class="dropdown-item">Edit</a>--}}
                                                {{--<a class="dropdown-item" data-toggle="modal"--}}
                                                   {{--data-target="#modal">Delete</a>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}

                                    {{--</td>--}}
                                </tr>
                                {{--<form action="{{route('admin.room.destroy', $room->id)}}" method="post">--}}
                                    {{--@csrf--}}
                                    {{--<div class="modal fade" id="modal{{$room->id}}" tabindex="-1" role="dialog"--}}
                                         {{--aria-labelledby="modal{{$room->id}}Label" aria-hidden="true">--}}
                                        {{--<div class="modal-dialog modal-dialog-centered" role="document">--}}
                                            {{--<div class="modal-content">--}}
                                                {{--<div class="modal-header">--}}
                                                    {{--<h5 class="modal-title" id="modal{{$room->id}}Label">Xóa khách--}}
                                                        {{--sạn {{$room->room_name}}</h5>--}}
                                                    {{--<button type="button" class="close" data-dismiss="modal"--}}
                                                            {{--aria-label="Close">--}}
                                                        {{--<span aria-hidden="true">&times;</span>--}}
                                                    {{--</button>--}}
                                                {{--</div>--}}
                                                {{--<div class="modal-body">--}}
                                                    {{--Bạn có chắc chắn xóa khách sạn {{$room->room_name}} ?--}}
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
                        {{--{{ $rooms->links() }}--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
