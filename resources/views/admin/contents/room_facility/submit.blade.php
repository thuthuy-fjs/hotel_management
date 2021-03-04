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
                            \ <h6 class="heading-small text-muted mb-4">Tiện ích</h6>
                            <input class="form-check-input" type="text" value="{{$room->id}}"
                                   id="room_id" name="room_id" hidden>
                            <div class="pl-lg-8">
                                @foreach($facilities as $facility)
                                    <div class="container">
                                        <div class="row par">
                                            <input class="form-check-input" type="checkbox"
                                                   value="{{$facility->id}}"
                                                   id="{{$facility->id}}" name="room_facility_id[]">
                                            <label class="form-check-label" for="{{$facility->id}}">
                                                {{$facility->facility}}
                                            </label>

                                        </div>
                                        {{--<div class="row textbox" id="textbox">--}}
                                            {{--<div class="col-md-10 ">--}}
                                                {{--<label for="description">Mô tả</label>--}}
                                                {{--<textarea id="description[]" name="description[]"--}}
                                                          {{--class="form-control mytinymce" rows="4" cols="50">--}}
                                            {{--</textarea>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
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
    {{--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>--}}
    <script language="javascript" type="text/javascript">
        $(document).ready(function () {
            $('.lfm-btn').filemanager('image', {'prefix': 'http://localhost:8080/hotel_management/public/laravel-filemanager'});

            // $('.room_facility').removeAttr('checked');
            // $('.room_facility').on('click', function () {
            //     var html = '<div class="row textbox">\n' +
            //                 '                    <div class="col-md-10">\n' +
            //                 '                        <label for="description">Mô tả</label>\n' +
            //                 '                        <textarea id="description" name="description" class="form-control mytinymce" rows="4" cols="50"></textarea>\n' +
            //                 '                     </div>\n' +
            //                 '                </div>';
            //
            //     var box = $(this).closest('div.par');
            //
            //     $(html).insertAfter(box);
            //     $('.lfm-btn').filemanager('image', {'prefix': 'http://localhost:8080/hotel_management/public/laravel-filemanager'});
            // });

            // $('.form-check-input').removeAttr('checked');
            // $('.form-check-input').on('click', function () {
            //     $(this).closest("div.par").find('.textbox').toggle();
            // });


            $('.form-check-input').click(function () {
                $('.textbox').toggle(this.checked);
            });
        });

        // $('.room_facility').removeAttr('checked');
        // $('.room_facility').on('click', function () {
        //
        //     $(this).closest("div.par").find('.mytinymce').toggle();
        // });
    </script>
@endsection
