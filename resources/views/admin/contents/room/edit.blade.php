@extends('admin.layouts.dashboard')
@section('title')
    Chỉnh sửa thông tin phòng {{$room->type->room_type}}
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
                            <div class="col-12">
                                <h3 class="mb-0">Chỉnh sửa thông tin phòng {{$room->type->room_type}} của khách
                                    sạn {{$room->hotel->hotel_name}} </h3>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('admin.room.update', $room->id) }}" method="post">
                            @csrf
                            <h6 class="heading-small text-muted mb-4">Thông tin phòng</h6>
                            <div class="pl-lg-4">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <input type="text" id="hotel_id" name="hotel_id" class="form-control"
                                                   value="{{$room->hotel_id}}" hidden>
                                            <label class="form-control-label" for="room_type_id">Loại phòng nghỉ</label><br>
                                            <select id="room_type_id" name="room_type_id"
                                                    class="form-control btn-sm btn-neutral">
                                                <option value="{{$room->room_type_id}}"
                                                        selected>{{$room->type->room_type}}</option>
                                                @foreach($types as $type)
                                                    @if($room->room_type_id !== $type->id)
                                                        <option value="{{$type->id}}">{{$type->room_type}}</option>
                                                    @endif
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
                                                   value="{{$room->room_number}}"
                                                   placeholder="Nhập số lượng phòng">
                                            @error('room_number')
                                            <span class="small text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="room_price">Giá phòng*</label>
                                            <input type="text" id="room_price" name="room_price" class="form-control"
                                                   value="{{$room->room_price}}"
                                                   placeholder="Nhập giá phòng">
                                            @error('room_price')
                                            <span class="small text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <?php
                                $images = $room->room_images ? json_decode($room->room_images) : array();
                                $i = 0;
                                ?>

                                <hr class="my-4"/>
                                <h6 class="heading-small text-muted mb-4">Ảnh*</h6>
                                <div class="pl-lg-4">
                                    <div class="row">
                                        <div class="col-md-12">
                                            @foreach($images as $image)
                                                <?php $i++ ?>
                                                <div class="form-group">
                                                    <label class="form-control-label" for="room_image">Ảnh*</label>
                                                    <div style="margin: 10px 0px">
                                                <span class="input-group-btn">
                                                 <a id="lfm{{ $i }}" data-input="thumbnail{{ $i }}"
                                                    data-preview="holder{{ $i }}"
                                                    class="btn btn-neutral lfm-btn">
                                                   <i class="fa fa-picture-o"></i> Chọn
                                                 </a>
                                                    <a class="remove-image btn btn-warning">
                                                   <i class="fa fa-remove"></i> Xóa
                                                 </a>
                                               </span>
                                                    </div>
                                                    <input id="thumbnail{{ $i }}" class="form-control" type="text"
                                                           value="{{$image}}" name="room_images[]">
                                                    @error('room_images')
                                                    <span class="small text-danger">{{ $message }}</span>
                                                    @enderror
                                                    <img id="holder{{ $i }}" src="{{ asset($image) }}"
                                                         style="margin-top:15px;max-height:150px;max-width:150px">
                                                </div>
                                            @endforeach

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
                            '                     <input id="thumbnail' + next + '" type="text" name="room_image[]" value="" class="form-control" placeholder="">\n' +
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
