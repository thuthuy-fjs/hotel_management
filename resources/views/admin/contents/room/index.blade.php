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
                            <select id="country" name="country" class="btn btn-sm btn-neutral">
                                <option value="" selected disabled>Quốc gia</option>
                                @foreach($countries as $country)
                                    <option value="{{$country->id}}">{{$country->country_name}}</option>
                                @endforeach

                            </select>
                            <select id="province" name="province" class="btn btn-sm btn-neutral">
                                <option value="" selected disabled>Tỉnh/Thành</option>
                            </select>

                            <select id="hotel" name="hotel" class="btn btn-sm btn-neutral">
                                <option value="" selected disabled>Khách sạn</option>
                            </select>
                            <input type="submit" class="btn btn-sm btn-neutral" value="Tìm kiếm">
                        </form>

                    </div>
                    <div class="col-lg-3">
                        <form class="navbar-search navbar-search-light form-inline"
                              action="{{route('admin.room.search')}}"
                              method="GET" name="search" id="search">
                            <div class="form-group input-group-sm mb-0">
                                <div class="input-group input-group-alternative input-group-merge input-group-sm">
                                    <div class="input-group-prepend input-group-sm">
                                        <span class="input-group-text"><i class="fas fa-search"></i></span>
                                    </div>
                                    <input class="form-control" name="search" placeholder="Search" type="text">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-3 text-right">
                        <a href="{{route('admin.room.create')}}" class="btn btn-sm btn-neutral">Thêm mới</a>
                        <div class="dropdown">
                            <button class="btn btn-neutral btn-sm dropdown-toggle" type="button"
                                    id="dropdownMenuButton"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Action
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" data-toggle="modal" data-target="#modal">Import</a>
                                @if(isset(request()->hotel))
                                    <a class="dropdown-item"
                                       href="{{route('admin.room.export', request()->hotel)}}">Export</a>
                                @elseif(isset(request()->search))
                                    <a class="dropdown-item"
                                       href="{{route('admin.room.export', request()->search)}}">Export</a>
                                @else
                                    <a class="dropdown-item"
                                       href="{{route('admin.room.export', 'all')}}">Export</a>
                                @endif
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
                                                <input type="file" class="custom-file-input" name="select_file"
                                                       accept=".xlsx, .xls, .csv"/>
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
                        </div>
                    </div>
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (isset($errors) && $errors->any())
                        @foreach ($errors->all() as $error)
                            <div class="alert alert-danger" role="alert">
                                {{ $error }}
                            </div>
                        @endforeach
                    @endif
                    @if (session()->has('failures'))

                        <table class="table table-danger">
                            <tr>
                                <th>Row</th>
                                <th>Attribute</th>
                                <th>Errors</th>
                                <th>Value</th>
                            </tr>

                            @foreach (session()->get('failures') as $validation)
                                <tr>
                                    <td>{{ $validation->row() }}</td>
                                    <td>{{ $validation->attribute() }}</td>
                                    <td>
                                        @foreach ($validation->errors() as $e)
                                            {{ $e }}
                                        @endforeach
                                    </td>
                                    <td>
                                        {{ $validation->values()[$validation->attribute()] }}
                                    </td>
                                </tr>
                            @endforeach
                        </table>

                    @endif

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
                                        {{$room->type->room_type}}
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
                                                    <h5 class="modal-title" id="modal{{$room->id}}Label">Xóa
                                                        phòng {{$room->room_name}}</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    Bạn có chắc chắn xóa phòng {{$room->room_name}} khách
                                                    sạn {{$room->hotel->hotel_name}} ?
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
                        {{ $rooms->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script type="text/javascript">
        $('#country').change(function () {
            var country_id = $(this).val();
            if (country_id) {
                $.ajax({
                    type: "GET",
                    url: "{{route('admin.hotel.list_provinces')}}?country_id=" + country_id,
                    success: function (res) {
                        if (res) {
                            $('#province').html('');
                            $('#province').append('<option value="" selected disabled>Tỉnh thành</option>');
                            console.log(res);
                            $.each(res, function (key, value) {
                                console.log(value.province_name);
                                $('#province').append('<option value="' + value.id + '">' + value.province_name + '</option>');
                            });

                        } else {
                            $('#province').html('');
                        }
                    }
                });
            } else {
                $('#province').html('');
                $('#city').html('');
            }
        });
        $('#province').change(function () {
            var province_id = $(this).val();
            console.log(province_id);
            if (province_id) {
                $.ajax({
                    type: "GET",
                    url: "{{route('admin.room.list_hotels')}}?province_id=" + province_id,
                    success: function (res) {
                        if (res) {
                            $('#hotel').html('');
                            $('#hotel').append('<option value="" selected disabled>Khách sạn</option>');
                            console.log(res);
                            $.each(res, function (key, value) {
                                console.log(value.hotel_name);
                                $('#hotel').append('<option value="' + value.id + '">' + value.hotel_name + '</option>');
                            });

                        } else {
                            $('#hotel').html('');
                        }
                    }
                });
            } else {
                $('#hotel').html('');
            }
        });
    </script>
@endsection
