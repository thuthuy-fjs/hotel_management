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
                            <h6 class="heading-small text-muted mb-4">Thông tin phòng</h6>
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

                                <hr class="my-4"/>
                                <h6 class="heading-small text-muted mb-4">Ảnh</h6>
                                <div class="pl-lg-4">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-control-label" for="room_image">Ảnh</label>
                                                <div style="margin: 10px 0px">
                                                <span class="input-group-btn">
                                                 <a id="lfm1" data-input="thumbnail1" data-preview="holder1"
                                                    class="btn btn-neutral lfm-btn">
                                                   <i class="fa fa-picture-o"></i> Choose
                                                 </a>
                                                    <a class="remove-image btn btn-warning">
                                                   <i class="fa fa-remove"></i> Xóa
                                                 </a>
                                               </span>
                                                </div>
                                                <input id="thumbnail1" class="form-control" type="text"
                                                       name="room_images[]">
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
                                        <button type="submit" class="btn btn-success">Save</button>
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
                            '                           <i class="fa fa-picture-o"></i> Choose\n' +
                            '                         </a>\n' +
                            '                            <a class="remove-image btn btn-warning ">\n' +
                            '                           <i class="fa fa-remove"></i> Xóa\n' +
                            '                         </a>\n' +
                            '                       </span>\n' +
                            '                     </div>\n' +
                            '                     <input id="thumbnail' + next + '" type="text" name="room_image[]" value="" class="form-control" id="room_image" placeholder="">\n' +
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
