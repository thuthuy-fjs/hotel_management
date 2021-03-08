@extends('admin.layouts.dashboard')
@section('title')
    Chi tiết phòng
@endsection
@section('content')
    <div class="header bg-primary pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">

                    <div class="col-lg-12">
                        <form action="{{route('admin.room.calendar')}}" method="get">
                            <select id="country" name="country" class="btn btn-sm btn-neutral">
                                <option value="" selected disabled>Quốc gia</option>
                                @foreach($countries as $country)
                                    <option value="{{$country->id}}">{{$country->country_name}}</option>
                                @endforeach

                            </select>
                            <select id="province" name="province" class="btn btn-sm btn-neutral">
                                <option value="" selected disabled>Tỉnh thành</option>
                            </select>

                            <select id="hotel" name="hotel" class="btn btn-sm btn-neutral">
                                <option value="" selected disabled>Khách sạn</option>
                            </select>
                            <input type="submit" class="btn btn-sm btn-neutral" value="Tìm kiếm">
                        </form>
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
                                <h3 class="mb-0">Chi tiết phòng</h3>
                            </div>
                        </div>
                    </div>
                    <!-- Light table -->

                    <div style="margin: 0px 15px">
                            {!! isset($calendar) ?  $calendar->calendar() : "" !!}
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
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
    <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css"/>
    {!! isset($calendar) ?  $calendar->script() : "" !!}
@endsection
