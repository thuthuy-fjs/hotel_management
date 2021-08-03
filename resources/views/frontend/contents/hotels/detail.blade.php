@extends('frontend.layouts.app')
@section('title')
    {{ $hotel->hotel_name }}
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
                                    @error('province')
                                    <span class="small text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input type="text" id="check_in_date" name="check_in_date"
                                           class="form-control" autocomplete="off"
                                           placeholder="Nhận phòng" value="{{$check_in_date}}">
                                </div>
                                <div class="form-group">
                                    <input type="text" id="check_out_date" name="check_out_date"
                                           class="form-control" autocomplete="off"
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
                                    <h2 class="mb-4">{{$hotel->hotel_name}}</h2>
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <img src="{{ $hotel->hotel_image }}"
                                                     alt="First slide"
                                                     style="height: 350px; width: 100%">
                                            </div>
                                        </div>
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
                                        <tr class="position-relative bg-info">
                                            <th scope="col">Loại chỗ nghỉ</th>
                                            <th scope="col">Phù hợp cho</th>
                                            <th scope="col">Tiện nghi</th>
                                            <th scope="col">Giá</th>
                                            <th scope="col">Số phòng</th>
                                            <th scope="col">Ảnh</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        @foreach($rooms as $room)
                                            <?php
                                            $number_room = $room->room_number;
                                            foreach ($bookings as $booking) {
                                                if ($room->id == $booking->room_id) {
                                                    $number_room -= $booking->number_room;
                                                }
                                            }
                                            ?>
                                            @if($number_room > 0)
                                                <tr>
                                                    <td>{{$room->type->room_type}}</td>
                                                    <td>{{$room->type->person_number}} người</td>
                                                    <td>
                                                        <?php
                                                        $room_facility = \App\Models\Admin\RoomFacilityModel::where('room_id',
                                                            $room->id)->first();
                                                        $room_facilities = $room_facility->room_facility_id ?
                                                            json_decode($room_facility->room_facility_id) : array();
                                                        ?>
                                                        @foreach($facilities as $facility)
                                                            @foreach($room_facilities as $room_facility)
                                                                @if($facility->id == $room_facility)
                                                                    <i class="bi bi-check2"></i>{{$facility->facility}}</br>
                                                                @endif
                                                            @endforeach
                                                        @endforeach

                                                    </td>
                                                    <td>{{$room->room_price}} <span class="per">vnd</span></td>
                                                    <td>

                                                        <select class="form-select" name="room_number" id="room_number">
                                                            @for($i = 0; $i<= $number_room;$i++)
                                                                <option value="{{$i}}">{{$i}}</option>
                                                            @endfor
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <a href="#" class="btn btn-success" id="dynamic{{$room->id}}"
                                                           name="dynamic{{$room->id}}">Ảnh</a>
                                                        {{--<a href="{{route('booking', ['id='.$room->id, 'province='.$province_name,--}}
                                                        {{--'check_in_date='.$check_in_date, 'check_out_date='.$check_out_date,--}}
                                                        {{--'person_number='.$person_number])}}"--}}
                                                        {{--class="btn btn-danger">Đặt</a>--}}
                                                    </td>
                                                    <input name="id[]" value="{{$room->id}}" hidden>
                                                    <input name="room_type[]" id="room_type"
                                                           value="{{$room->type->room_type}}" hidden>
                                                    <input name="room_price[]" id="room_price"
                                                           value="{{$room->room_price}}" hidden>
                                                </tr>
                                            @endif
                                        @endforeach
                                        </tbody>
                                    </table>

                                </div>
                                <div class="icon-bar">
                                    <div class="col-xs-9">
                                        <button type="button" class="btn btn-lg btn-primary" data-toggle="collapse"
                                                data-target="#booking">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                 fill="currentColor" class="bi bi-bag-check" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd"
                                                      d="M10.854 8.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L7.5 10.793l2.646-2.647a.5.5 0 0 1 .708 0z"></path>
                                                <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z"></path>
                                            </svg>
                                            Đặt
                                        </button>
                                        <div id="booking"
                                             class="card border-left-primary shadow h-100 py-2 collapse in">
                                            <div class="card-body" style="max-width: 500px;">
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col mr-2">
                                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                            {{$hotel->hotel_name}}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row" id="bookingRoom">

                                                </div>
                                                <form action="{{route('booking')}}" method="get">
                                                    <input name="room_id" id="room_id" hidden>
                                                    <input name="province" id="province"
                                                           value="{{$province_name}}" hidden>
                                                    <input name="check_in_date" id="check_in_date"
                                                           value="{{$check_in_date}}" hidden>
                                                    <input name="number_room" id="number_room" hidden>
                                                    <input name="check_out_date" id="check_in_date"
                                                           value="{{$check_out_date}}" hidden>
                                                    <input name="person_number" id="person_number"
                                                           value="{{$person_number}}" hidden>
                                                    <input name="total_price" id="total_price" hidden>

                                                    <div class="col-sm-12 text-right buttonBooking" id="buttonBooking">
                                                        <button type="submit" class="btn btn-primary">Đặt phòng
                                                        </button>
                                                    </div>
                                                </form>
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
                                        @foreach($hotel->rooms as $room)
                                            @foreach($room->bookings as $booking)
                                                @if($booking->id == $star_rating->booking_id)
                                                    <div class="card">
                                                        <div class="row d-flex">
                                                            <div class="">
                                                                <img class="profile-pic"
                                                                     src="{{isset(Auth::user()->image) ? 'uploads/'. Auth::user()->image: asset('images/user.png')}}">
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
                                                @endif
                                            @endforeach
                                        @endforeach
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

        .content {
            font-size: 18px
        }

        .profile-pic {
            width: 90px;
            height: 90px;
            border-radius: 100%;
            margin-right: 30px
        }

        .icon-bar {
            z-index: 999;
            position: fixed;
            right: 0%;
            top: 50%;
            -webkit-transform: translateY(-50%);
            -ms-transform: translateY(-50%);
            transform: translateY(-50%);
        }
    </style>
@endsection
@section('js')
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
        $("#buttonBooking").hide();
        $(document).on('change', 'select[name="room_number"]', function () {
            var room_id = [];
            var room_number = [];
            var room_type = [];
            var room_price = [];
            $('select[name="room_number"]').each(function () {
                room_number.push($(this).val());
            });
            $("input[name='room_type[]']").each(function () {
                room_type.push($(this).val());
            });
            $("input[name='room_price[]']").each(function () {
                room_price.push($(this).val());
            });

            $("input[name='id[]']").each(function () {
                room_id.push($(this).val());
            });

            console.log(room_number);
            var i;
            var text = '';
            var total_price = 0;
            for (i = 0; i < room_number.length; i++) {
                if (room_number[i] > 0) {
                    total_price += (room_number[i] * room_price[i]);
                    text += '<div class="col-md-12">' +
                        '<b style="margin-right: 10px;">Loại phòng: </b>' + room_type[i] + '<br>' +
                        '<b style="margin-right: 10px;">Số lượng: </b>' + room_number[i] + '<hr>' +
                        '</div>';

                }

            }
            if (total_price > 0) {
                text += '<b style="margin-right: 10px;">Tổng giá: </b>' + total_price;
                $("#bookingRoom").html(text);
                $("#buttonBooking").show();
            } else {
                $("#bookingRoom").html('');
                $("#buttonBooking").hide();
            }

            $('#total_price').val(total_price);
            $('#room_id').val(room_id.join(", "));
            $('#number_room').val(room_number.join(", "));

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
