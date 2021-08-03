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
                    <div class="card-body">
                        <form action="{{ route('admin.room.store') }}" method="post">
                            @csrf
                            <h6 class="heading-small text-muted mb-4">Thông tin phòng</h6>
                            <div class="pl-lg-4">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-control-label" for="country_id">Quốc gia*</label><br>
                                            <select id="country" name="country" class="form-control btn-sm btn-neutral">
                                                <option value="" selected disabled>Quốc gia</option>
                                                @foreach($countries as $country)
                                                    <option value="{{$country->id}}">{{$country->country_name}}</option>
                                                @endforeach

                                            </select>
                                            @error('country')
                                            <span class="small text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-control-label" for="province_id">Tỉnh/Thành
                                                phố*</label><br>
                                            <select id="province" name="province" class="form-control btn-sm btn-neutral">
                                                <option value="" selected disabled>Tỉnh/Thành</option>
                                            </select>
                                            @error('province')
                                            <span class="small text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-control-label" for="hotel_id">Khách sạn*</label><br>
                                            <select id="hotel_id" name="hotel_id" class="form-control btn-sm btn-neutral">
                                                <option value="" selected disabled>Khách sạn</option>
                                            </select>
                                        </div>
                                        @error('hotel_id')
                                        <span class="small text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="room_type_id">Loại phòng nghỉ*</label><br>
                                            <select id="room_type_id" name="room_type_id"
                                                    class="form-control btn-sm btn-neutral">
                                                <option value="" selected disabled>Loại phòng nghỉ</option>
                                                @foreach($types as $type)
                                                    <option value="{{$type->id}}">{{$type->room_type}}</option>
                                                @endforeach
                                            </select>
                                            @error('room_type_id')
                                            <span class="small text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="room_number">Số lượng*</label>
                                            <input type="text" id="room_number" name="room_number" class="form-control"
                                                   placeholder="Nhập số lượng phòng" value="{{old('room_number')}}">
                                            @error('room_number')
                                            <span class="small text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="room_price">Giá phòng*</label>
                                            <input type="text" id="room_price" name="room_price" class="form-control"
                                                   placeholder="Nhập giá phòng" value="{{old('room_price')}}">
                                            @error('room_price')
                                            <span class="small text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <hr class="my-4"/>
                                <h6 class="heading-small text-muted mb-4">Ảnh</h6>
                                <div class="pl-lg-4">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-control-label" for="room_image">Ảnh*</label>
                                                <div style="margin: 10px 0px">
                                                <span class="input-group-btn">
                                                 <a id="lfm1" data-input="thumbnail1" data-preview="holder1"
                                                    class="btn btn-neutral lfm-btn">
                                                   <i class="fa fa-picture-o"></i> Chọn
                                                 </a>
                                                    <a class="remove-image btn btn-warning">
                                                   <i class="fa fa-remove"></i> Xóa
                                                 </a>
                                               </span>
                                                </div>
                                                <input id="thumbnail1" class="form-control" type="text"
                                                       name="room_images[]">
                                                @error('room_images')
                                                <span class="small text-danger">{{ $message }}</span>
                                                @enderror
                                                <img id="holder1"
                                                     style="margin-top:15px;max-height:150px;max-width:150px">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-control-label" for="description">Thêm ảnh</label>
                                                <div style="margin: 10px 0px">
                                                    <a id="plus-image" class="btn btn-success">
                                                        <i class="fa fa-plus"></i> Thêm
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 text-right">
                                        <button type="submit" class="btn btn-success">Tiếp theo</button>
                                    </div>
                                </div>
                            </div>
                        </form>
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
                            $('#hotel_id').html('');
                            $('#hotel_id').append('<option value="" selected disabled>Khách sạn</option>');
                            console.log(res);
                            $.each(res, function (key, value) {
                                console.log(value.hotel_name);
                                $('#hotel_id').append('<option value="' + value.id + '">' + value.hotel_name + '</option>');
                            });

                        } else {
                            $('#hotel_id').html('');
                        }
                    }
                });
            } else {
                $('#hotel_id').html('');
            }
        });
    </script>

    <script src="{{ asset('/vendor/laravel-filemanager/js/stand-alone-button.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('.lfm-btn').filemanager('image', {'prefix': 'http://localhost:8080/hotel_management/public/laravel-filemanager'});


            $('#plus-image').on('click', function (e) {
                e.preventDefault();

                var lfm_count = parseInt($('.lfm-btn').length);
                var next = lfm_count + 1;

                var html = '';

                for (var i = 0; i < 1000; i++) {

                    if ($('#lfm' + next).length < 1) {

                        html += '<div class="form-group">\n' +
                            '                    <label for="room_image" class="form-control-label">Ảnh </label>\n' +
                            '                    <div style="margin: 10px 0px">\n' +
                            '                        <span class="input-group-btn">\n' +
                            '                         <a id="lfm' + next + '" data-input="thumbnail' + next + '" data-preview="holder' + next + '" class="lfm-btn btn btn-neutral">\n' +
                            '                           <i class="fa fa-picture-o"></i> Chọn\n' +
                            '                         </a>\n' +
                            '                            <a class="remove-image btn btn-warning ">\n' +
                            '                           <i class="fa fa-remove"></i> Xóa\n' +
                            '                         </a>\n' +
                            '                       </span>\n' +
                            '                     </div>\n' +
                            '                     <input id="thumbnail' + next + '" type="text" name="room_images[]" value="" class="form-control" placeholder="">\n' +
                            '                     <img id="holder' + next + '" style="margin-top:15px;max-height:100px;">\n' +
                            '                </div>';


                        break;
                    } else {
                        next++;
                    }


                }

                var box = $(this).closest('.form-group');

                $(html).insertBefore(box);

                $('.lfm-btn').filemanager('image', {'prefix': 'http://localhost:8080/hotel_management/public/laravel-filemanager'});

            });


            $('body').on('click', '.remove-image', function (e) {
                console.log(e);
                e.preventDefault();
                $(this).closest('.form-group').remove();

            });

            // $('.remove-image').on('click', function (e) {
            //     console.log(e);
            //     e.preventDefault();
            //     $(this).closest('.form-group').remove();
            // });


        });

    </script>
@endsection
