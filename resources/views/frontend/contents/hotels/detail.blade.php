@extends('frontend.layouts.app')
@section('title')
    Khách sạn {{ $hotel->hotel_name }}
@endsection
@section('content')
    <section class="ftco-section bg-light">
        <div class="container">
            <div class="row">
                <div class="col-sm-3 sidebar">
                    <div class="sidebar-wrap bg-light ftco-animate">
                        <h3 class="heading mb-4">Tìm kiếm</h3>
                        <form action="{{route('search')}}" method="get">
                            <div class="fields">
                                <div class="form-group">
                                    <select class="form-control" id="province" name="province">
                                        <option value="" selected disabled>Địa điểm</option>
                                        @foreach($provinces as $province)
                                            @if ($province->id == $province_name)
                                                <option value="{{ $province->id }}"
                                                        selected>{{ $province->province_name }}</option>
                                            @else
                                                <option value="{{ $province->id }}">{{ $province->province_name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <input type="text" id="check_in_date" name="check_in_date"
                                           class="form-control"
                                           placeholder="Nhận phòng" value="{{$check_in_date}}">
                                </div>
                                <div class="form-group">
                                    <input type="text" id="check_out_date" name="check_out_date"
                                           class="form-control"
                                           placeholder="Trả phòng" value="{{$check_out_date}}">
                                </div>
                                <div class="form-group">
                                    <div class="select-wrap one-third">
                                        <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                                        <select name="person_number" id="person_number" class="form-control">
                                            @for($i = 1; $i<5; $i++)
                                                @if($i == $person_number)
                                                    <option value="{{$person_number}}" selected>{{$person_number}} người
                                                    </option>
                                                @else
                                                    <option value="{{$i}}">{{$i}} người</option>
                                                @endif
                                            @endfor

                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="submit" value="Search" class="btn btn-primary py-3 px-5">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-lg-12">
                                    <ul class="nav nav-pills nav-justified" id="tabs-icons-text" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link mb-sm-3 mb-md-0 active" id="info-tab" href="#info"
                                               role="tab" aria-controls="info" aria-selected="true"><i
                                                        class="ni ni-cloud-upload-96 mr-2"></i>Thông tin</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link mb-sm-3 mb-md-0" id="facility-tab" href="#facility"
                                               role="tab" aria-controls="facility" aria-selected="false"><i
                                                        class="ni ni-bell-55 mr-2"></i>Tiện nghi</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link mb-sm-3 mb-md-0" id="rule-tab" href="#rule"
                                               role="tab" aria-controls="rule" aria-selected="false"><i
                                                        class="ni ni-calendar-grid-58 mr-2"></i>Quy tắc chung</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link mb-sm-3 mb-md-0" id="evaluate-tab" href="#evaluate"
                                               role="tab" aria-controls="evaluate" aria-selected="false"><i
                                                        class="ni ni-calendar-grid-58 mr-2"></i>Đánh giá</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 ftco-animate justify-content-center">
                                    <h2 class="mb-4">Khách sạn {{$hotel->hotel_name}}</h2>
                                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                                        <ol class="carousel-indicators">
                                            <li data-target="#carouselExampleIndicators" data-slide-to="0"
                                                class="active"></li>
                                            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                                            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                                        </ol>
                                        <div class="carousel-inner">
                                            <div class="carousel-item active">
                                                <img class="d-block w-100" src="{{ asset($hotel->hotel_image) }}"
                                                     alt="First slide"
                                                     style="height: 300px; width: 60%">
                                            </div>
                                            <div class="carousel-item">
                                                <img class="d-block w-100" src="{{ asset($hotel->hotel_image) }}"
                                                     alt="First slide"
                                                     style="height: 300px; width: 60%">
                                            </div>
                                            <div class="carousel-item">
                                                <img class="d-block w-100" src="{{ asset($hotel->hotel_image) }}"
                                                     alt="First slide"
                                                     style="height: 300px; width: 60%">
                                            </div>
                                        </div>
                                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button"
                                           data-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button"
                                           data-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Next</span>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-12 room-single mt-4 mb-5 ftco-animate" id="info">
                                    <p>{!! $hotel->description !!}</p>
                                    <div class="d-md-flex mt-5 mb-5">
                                        <ul class="list">
                                            <li>
                                                <span>Website: </span> {{isset($hotel->hotel_website) ? $hotel->hotel_website: 'Không có'}}
                                            </li>
                                            <li><span>Điện thoại liên hệ: </span>{{$hotel->hotel_phone}}</li>
                                        </ul>
                                        <ul class="list ml-md-5">
                                            <li><span>Email: </span>{{$hotel->hotel_email}}</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-12 room-single ftco-animate mb-5 mt-4">
                                    <h3 class="mb-4">Phòng trống</h3>
                                    <table class="table table-bordered ">
                                        <thead>
                                        <tr class="bg-info">
                                            <th scope="col">Loại chỗ nghỉ</th>
                                            <th scope="col">Phù hợp cho</th>
                                            <th scope="col">Giá</th>
                                            <th scope="col"></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($rooms as $room)
                                            <tr>
                                                <td>{{$room->type->room_type}}</td>
                                                <td>{{$room->type->person_number}} người</td>
                                                <td>{{$room->room_price}} <span class="per">vnd</span></td>
                                                <td>
                                                    <a href="#" class="btn btn-success" id="dynamic{{$room->id}}"
                                                       name="dynamic{{$room->id}}">Ảnh</a>
                                                    <a href="{{route('booking', ['id='.$room->id, 'province='.$province_name,
                                                    'check_in_date='.$check_in_date, 'check_out_date='.$check_out_date,
                                                    'person_number='.$person_number])}}"
                                                       class="btn btn-danger">Đặt</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    {{--<div id="booking"><a href="{{route('booking', ['id='.$room->id, 'province='.$province_name,--}}
                                    {{--'check_in_date='.$check_in_date, 'check_out_date='.$check_out_date,--}}
                                    {{--'person_number='.$person_number])}}"--}}
                                    {{--class="btn btn-danger">Đặt</a></div>--}}
                                </div>
                                <div class="col-md-12 room-single ftco-animate mb-5 mt-4" id="facility">
                                    <h3 class="mb-4">Tiện nghi</h3>
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <ul class="list-unstyled list-group-flush clearfix"
                                                    style="display: list-item;text-align: -webkit-match-parent;">
                                                    @foreach($rooms as $room)
                                                        @foreach($room->facilities as $facility)
                                                            @if($facility)
                                                                <p class="list-group-item h-25 w-25 p-3"
                                                                   style="padding: 0 5px 0 0;margin: 10px 10px;list-style: none; float: left">
                                                                    <i class="bi bi-check2"></i>{{$facility->room_facility->facility}}
                                                                </p>
                                                            @endif
                                                        @endforeach
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12 room-single ftco-animate mb-5 mt-4" id="rule">
                                    <h3 class="mb-4">Quy tắc chung</h3>
                                    <div class="container">
                                        <div class="row rule">
                                            <div class="col-md-4">
                                                <span><i class="bi bi-calendar-check-fill"></i> Nhận phòng</span>
                                            </div>
                                            <div class="col-md-8">
                                                <input type="range" class="form-control-range" value="14" min="0"
                                                       max="24" name="foo"
                                                       disabled>
                                                <output for="foo"></output>
                                            </div>
                                        </div>
                                        <div class="row rule">
                                            <div class="col-md-4">
                                                <span><i class="bi bi-calendar-minus-fill"></i> Trả phòng</span>
                                            </div>
                                            <div class="col-md-8">
                                                <input type="range" class="form-control-range" value="12" min="0"
                                                       max="24" name="foo"
                                                       disabled>
                                                <output for="foo"></output>
                                            </div>
                                        </div>
                                        <div class="row rule">
                                            <div class="col-md-4">
                                                <span><i class="bi bi-info-circle-fill"></i> Trẻ em và giường</span>
                                            </div>
                                            <div class="col-md-8">
                                                <b>Chính sách trẻ em</b>
                                                <p>Phù hợp cho tất cả trẻ em.<br>Trẻ em từ 7 tuổi trở lên được tính như
                                                    người lớn tại chỗ
                                                    nghỉ này.</p>
                                                <b>Chính sách nôi và giường phụ</b>
                                                <p>Chỗ nghỉ không có chỗ cho nôi (cũi).<br>Chỗ nghỉ không có chỗ cho
                                                    giường phụ.</p>
                                            </div>
                                        </div>
                                        <div class="row rule">
                                            <div class="col-md-4">
                                                <span><i class="bi bi-person-fill"></i> Giới hạn độ tuổi</span>
                                            </div>
                                            <div class="col-md-8">
                                                <p>Độ tuổi tối thiểu để nhận phòng là 18</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12 properties-single ftco-animate mb-5 mt-4" id="evaluate">
                                    <h4 class="mb-4">Đánh giá</h4>
                                    @foreach($star_ratings as $star_rating)
                                        <div class="card">
                                            <div class="row d-flex">
                                                <div class="">
                                                    <img class="profile-pic" src="{{asset('images/user.png')}}">
                                                </div>
                                                <div class="d-flex flex-column">
                                                    <h3 class="mt-2 mb-0">{{$star_rating->guest->user_name}}</h3>
                                                    <div>
                                                        <p class="text-left">
                                                            @for($i = 1; $i < 6; $i++)
                                                                @if($i <= $star_rating->level)
                                                                    <span class="fa fa-star star-active"></span>
                                                                @else
                                                                    <span class="fa fa-star star-inactive"></span>
                                                                @endif
                                                            @endfor
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="ml-auto">
                                                    <p class="text-muted pt-5 pt-sm-3">{{\Carbon\Carbon::parse($star_rating->create_at)->format('d/m/y')}}</p>
                                                </div>
                                            </div>
                                            <div class="row text-left">
                                                <p class="content">{{$star_rating->description}}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                    {{$star_ratings->links()}}
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <style>
        .rule {
            margin: 35px 0px;
        }

        output {
            position: absolute;
            background-image: linear-gradient(#444444, #999999);
            width: 45px;
            height: 30px;
            text-align: center;
            color: white;
            border-radius: 10px;
            display: inline-block;
            font: bold 15px/30px Georgia;
            bottom: 175%;
            left: 0;
        }

        output:after {
            content: "";
            position: absolute;
            width: 0;
            height: 0;
            border-top: 5px solid #999999;
            border-left: 5px solid transparent;
            border-right: 5px solid transparent;
            top: 100%;
            left: 50%;
            margin-left: -5px;
            margin-top: -1px;
        }

        input[type=range]:focus {
            outline: none;
        }

        input[type=range]::-webkit-slider-runnable-track {
            width: 100%;
            height: 5px;
            cursor: pointer;
            animate: 0.2s;
            background: #0b1526;
            border-radius: 30px;
        }

        input[type=range]::-webkit-slider-thumb {
            height: 20px;
            width: 20px;
            border-radius: 50%;
            background: #fff;
            box-shadow: 0 0 4px 0 rgba(0, 0, 0, 1);
            cursor: pointer;
            -webkit-appearance: none;
            margin-top: -8px;
        }

        input[type=range]:focus::-webkit-slider-runnable-track {
            background: #03a9f4;
        }

        .card {
            position: relative;
            display: flex;
            flex-direction: column;
            min-width: 0;
            padding: 20px;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border-radius: 6px;
            -moz-box-shadow: 0px 0px 5px 0px rgba(212, 182, 212, 1)
        }

        .comment-box {
            padding: 5px
        }

        .comment-area textarea {
            resize: none;
            border: 1px solid #ad9f9f
        }

        .form-control:focus {
            color: #495057;
            background-color: #fff;
            border-color: #ffffff;
            outline: 0;
            box-shadow: 0 0 0 1px rgb(255, 0, 0) !important
        }

        .send {
            color: #fff;
            background-color: #ff0000;
            border-color: #ff0000
        }

        .send:hover {
            color: #fff;
            background-color: #f50202;
            border-color: #f50202
        }

        .rating {
            display: flex;
            margin-top: -10px;
            flex-direction: row-reverse;
            margin-left: -4px;
            float: left
        }

        .rating > input {
            display: none
        }

        .rating > label {
            position: relative;
            width: 19px;
            font-size: 25px;
            color: #ff0000;
            cursor: pointer
        }

        .rating > label::before {
            content: "\2605";
            position: absolute;
            opacity: 0
        }

        .rating > label:hover:before,
        .rating > label:hover ~ label:before {
            opacity: 1 !important
        }

        .rating > input:checked ~ label:before {
            opacity: 1
        }

        .rating:hover > input:checked ~ label:before {
            opacity: 0.4
        }

        a {
            text-decoration: none !important;
            color: inherit
        }

        a:hover {
            color: #455A64
        }

        .card {
            border-radius: 5px;
            background-color: #fff;
            padding-left: 60px;
            padding-right: 60px;
            margin-top: 30px;
            padding-top: 30px;
            padding-bottom: 30px
        }

        .rating-box {
            width: 130px;
            height: 130px;
            margin-right: auto;
            margin-left: auto;
            background-color: #FBC02D;
            color: #fff
        }

        .rating-label {
            font-weight: bold
        }

        .rating-bar {
            width: 300px;
            padding: 8px;
            border-radius: 5px
        }

        .bar-container {
            width: 100%;
            background-color: #f1f1f1;
            text-align: center;
            color: white;
            border-radius: 20px;
            cursor: pointer;
            margin-bottom: 5px
        }

        .bar-5 {
            width: 70%;
            height: 13px;
            background-color: #FBC02D;
            border-radius: 20px
        }

        .bar-4 {
            width: 30%;
            height: 13px;
            background-color: #FBC02D;
            border-radius: 20px
        }

        .bar-3 {
            width: 20%;
            height: 13px;
            background-color: #FBC02D;
            border-radius: 20px
        }

        .bar-2 {
            width: 10%;
            height: 13px;
            background-color: #FBC02D;
            border-radius: 20px
        }

        .bar-1 {
            width: 0%;
            height: 13px;
            background-color: #FBC02D;
            border-radius: 20px
        }

        td {
            padding-bottom: 10px
        }

        .star-active {
            color: #FBC02D;
            margin-top: 10px;
            margin-bottom: 10px
        }

        .star-active:hover {
            color: #F9A825;
            cursor: pointer
        }

        .star-inactive {
            color: #CFD8DC;
            margin-top: 10px;
            margin-bottom: 10px
        }

        .blue-text {
            color: #0091EA
        }

        .content {
            font-size: 18px
        }

        .profile-pic {
            width: 90px;
            height: 90px;
            border-radius: 100%;
            margin-right: 30px
        }

        .pic {
            width: 80px;
            height: 80px;
            margin-right: 10px
        }

        .vote {
            cursor: pointer
        }
    </style>
@endsection
@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/datepicker/0.6.5/datepicker.min.css" rel="stylesheet"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datepicker/0.6.5/datepicker.min.js"></script>
    <script type="text/javascript">
        $(function () {
            $("#check_in_date").datepicker({
                autoclose: true,
                todayHighlight: 'TRUE',
                startDate: new Date()
            });
            $("#check_out_date").datepicker({
                autoclose: true,
                todayHighlight: 'TRUE',
                startDate: new Date()
            });
        });
    </script>
    <script>
        function modifyOffset() {
            var el, newPoint, newPlace, offset, siblings, k;
            width = this.offsetWidth;
            newPoint = (this.value - this.getAttribute("min")) / (this.getAttribute("max") - this.getAttribute("min"));
            offset = -1;
            if (newPoint < 0) {
                newPlace = 0;
            } else if (newPoint > 1) {
                newPlace = width;
            } else {
                newPlace = width * newPoint + offset;
                offset -= newPoint;
            }
            siblings = this.parentNode.childNodes;
            for (var i = 0; i < siblings.length; i++) {
                sibling = siblings[i];
                if (sibling.id == this.id) {
                    k = true;
                }
                if ((k == true) && (sibling.nodeName == "OUTPUT")) {
                    outputTag = sibling;
                }
            }
            outputTag.style.left = newPlace + "px";
            outputTag.style.marginLeft = offset + "%";
            outputTag.innerHTML = this.value + "h";
        }

        function modifyInputs() {

            var inputs = document.getElementsByTagName("input");
            for (var i = 0; i < inputs.length; i++) {
                if (inputs[i].getAttribute("type") == "range") {
                    inputs[i].onchange = modifyOffset;

                    // the following taken from http://stackoverflow.com/questions/2856513/trigger-onchange-event-manually
                    if ("fireEvent" in inputs[i]) {
                        inputs[i].fireEvent("onchange");
                    } else {
                        var evt = document.createEvent("HTMLEvents");
                        evt.initEvent("change", false, true);
                        inputs[i].dispatchEvent(evt);
                    }
                }
            }
        }

        modifyInputs();
        <?php foreach ($hotel->rooms as $room) { ?>
        $('#dynamic{{$room->id}}').on('click', function () {
            $(this).lightGallery({
                thumbnail: true,
                dynamic: true,
                dynamicEl: [
                        <?php foreach (json_decode($room->room_images) as $image) { ?>
                    {
                        "src": '<?php echo $image; ?>',
                        'thumb': '../static/img/thumb-1.jpg',
                    },
                    <?php } ?>
                ]
            })


        });
        <?php } ?>
        <!---->
        //        $(document).scroll(function() {
        //            var y = $(document).scrollTop(), //get page y value
        //                header = $("#booking"); // your div id
        //            if(y >= 400)  {
        //                header.css({position: "fixed", "top" : "0", "left" : "0"});
        //            } else {
        //                header.css("position", "static");
        //            }
        //        });


    </script>
@endsection
