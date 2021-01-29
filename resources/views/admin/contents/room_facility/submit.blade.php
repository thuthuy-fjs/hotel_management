@extends('admin.layouts.dashboard')
@section('title')
    Thêm ảnh phòng
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
                                <h3 class="mb-0">Thêm tiện ích phòng {{$room->room_name}} </h3>
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
                        <form action="{{ route('admin.room.facility.store') }}" method="post">
                            @csrf
                            <hr class="my-4"/>
                            <h6 class="heading-small text-muted mb-4">Tiện ích</h6>
                            <input class="form-check-input" type="text" value="{{$room->id}}"
                                   id="room_id" name="room_id" hidden>
                            <div class="pl-lg-4">
                                @foreach($facilities as $facility)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="{{$facility->id}}"
                                               id="{{$facility->id}}" name="room_facility_id[]">
                                        <label class="form-check-label" for="{{$facility->id}}">
                                            {{$facility->facility}}
                                        </label>
                                    </div>

                                @endforeach
                                <div class="col-sm-12 text-right">
                                    <button type="submit" class="btn btn-success">Save</button>
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


            $(body).on('click', '.remove-image', function (e) {
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
