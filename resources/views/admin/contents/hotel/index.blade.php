@extends('admin.layouts.dashboard')
@section('title')
    Khách sạn
@endsection
@section('content')
    <div class="header bg-primary pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">

                    <div class="col-lg-4">
                        <select id="country" name="country" class="selectpicker" data-style="btn-sm btn-neutral"
                                data-live-search="true">
                            <option value="" selected disabled>Quốc gia</option>
                            @foreach($countries as $country)
                                <option value="{{$country->id}}">{{$country->country_name}}</option>
                            @endforeach

                        </select>
                    </div>
                    <div class="col-lg-4">
                        <select id="province" name="province" class="selectpicker"
                                data-style="btn-sm btn-neutral"
                                data-live-search="true">
                            <option value="" selected disabled>Tỉnh/Thành phố</option>
                        </select>
                    </div>

                    <div class="col-lg-4 text-right">
                        <a href="{{route('admin.hotel.create')}}" class="btn btn-sm btn-neutral">Thêm mới</a>
                        <div class="dropdown">
                            <button class="btn btn-neutral btn-sm dropdown-toggle" type="button"
                                    id="dropdownMenuButton"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Action
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="#">Import</a>
                                <a class="dropdown-item" href="#">Export</a>
                            </div>
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
                        <h3 class="mb-0">Khách sạn</h3>
                    </div>
                    <!-- Light table -->
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tên khách sạn</th>
                                <th scope="col">Điện thoại</th>
                                <th scope="col">Email</th>
                                <th scope="col">Website</th>
                                <th scope="col">Ẩn/hiện</th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody class="list">
                            @foreach($hotels as $hotel)
                                <tr>
                                    <td>
                                        {{$hotel->id}}
                                    </td>
                                    <th scope="row">
                                        <div class="media align-items-center">
                                            <a href="#" class="avatar rounded-circle mr-3">
                                                <img alt="Image placeholder" src="{{$hotel->hotel_image}}">
                                            </a>
                                            <div class="media-body">
                                                <span class="name mb-0 text-sm">{{$hotel->hotel_name}}</span>
                                            </div>
                                        </div>
                                    </th>
                                    <td>
                                        {{$hotel->hotel_phone}}
                                    </td>

                                    <td>
                                        {{$hotel->hotel_email}}
                                    </td>

                                    <td>
                                        {{$hotel->hotel_website}}
                                    </td>

                                    <td>
                                        {{$hotel->is_active}}
                                    </td>
                                    <td class="text-right">
                                        <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                <a class="dropdown-item"
                                                   href="{{route('admin.hotel.edit', $hotel->id)}}">Edit</a>
                                                <a class="dropdown-item"
                                                   href="{{route('admin.hotel.delete', $hotel->id)}}">Delete</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $hotels->links() }}
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
                            $('#province').append('<option value="" selected disabled>Tỉnh/Thành phố</option>');
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

        {{--$('#country').on('change', function(e){--}}
            {{--console.log(e);--}}
            {{--var country_id = e.target.value;--}}
            {{--$.get("{{route('admin.hotel.list_provinces')}}?country_id=" + country_id,function(data) {--}}
                {{--console.log(data);--}}
                {{--$('#province').empty();--}}
                {{--$('#province').append('<option value="0" disable="true" selected="true">=== Select province ===</option>');--}}

                {{--$.each(data, function(index, value){--}}
                    {{--console.log(value.province_name);--}}
                    {{--$('#province').append('<option value="'+ value.id +'">'+ value.province_name +'</option>');--}}
                {{--})--}}
            {{--});--}}
        {{--});--}}
    </script>
@endsection
