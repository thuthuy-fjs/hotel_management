@extends('frontend.layouts.hotel')
@section('title')
    Khách sạn {{$hotel->hotel_name }}
@endsection
@section('content')

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
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img class="d-block w-100" src="{{ asset($hotel->hotel_image) }}" alt="First slide"
                                 style="height: 300px; width: 60%">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="{{ asset($hotel->hotel_image) }}" alt="First slide"
                                 style="height: 300px; width: 60%">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="{{ asset($hotel->hotel_image) }}" alt="First slide"
                                 style="height: 300px; width: 60%">
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
            <div class="col-md-12 room-single mt-4 mb-5 ftco-animate" id="info">
                <p>{!! $hotel->description !!}</p>
                <div class="d-md-flex mt-5 mb-5">
                    <ul class="list">
                        <li><span>Website: </span> {{isset($hotel->hotel_website) ? $hotel->hotel_website: 'Không có'}}
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
                <div class="block-16">

                </div>
            </div>
            <div class="col-md-12 room-single ftco-animate mb-5 mt-4" id="facility">
                <h3 class="mb-4">Tiện nghi</h3>

            </div>

            <div class="col-md-12 room-single ftco-animate mb-5 mt-4" id="rule">
                <h3 class="mb-4">Quy tắc chung</h3>
                <div class="container">
                    <div class="row rule">
                        <div class="col-md-4">
                            <span><i class="bi bi-calendar-check-fill"></i> Nhận phòng</span>
                        </div>
                        <div class="col-md-8">
                            <input type="range" class="form-control-range" value="14" min="0" max="24" name="foo" disabled>
                            <output for="foo"></output>
                        </div>
                    </div>
                    <div class="row rule">
                        <div class="col-md-4">
                            <span><i class="bi bi-calendar-minus-fill"></i> Trả phòng</span>
                        </div>
                        <div class="col-md-8">
                            <input type="range" class="form-control-range" value="12" min="0" max="24" name="foo" disabled>
                            <output for="foo"></output>
                        </div>
                    </div>
                    <div class="row rule">
                        <div class="col-md-4">
                            <span><i class="bi bi-info-circle-fill"></i> Trẻ em và giường</span>
                        </div>
                        <div class="col-md-8">
                            <b>Chính sách trẻ em</b>
                            <p>Phù hợp cho tất cả trẻ em.<br>Trẻ em từ 7 tuổi trở lên được tính như người lớn tại chỗ nghỉ này.</p>
                            <b>Chính sách nôi và giường phụ</b>
                            <p>Chỗ nghỉ không có chỗ cho nôi (cũi).<br>Chỗ nghỉ không có chỗ cho giường phụ.</p>
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
                <div class="row">
                    <div class="col-md-6">
                        <form method="post" class="star-rating">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                <label class="form-check-label" for="exampleCheck1">
                                    <p class="rate"><span><i class="icon-star"></i><i class="icon-star"></i><i
                                                    class="icon-star"></i><i class="icon-star"></i><i
                                                    class="icon-star"></i> 100 Ratings</span></p>
                                </label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                <label class="form-check-label" for="exampleCheck1">
                                    <p class="rate"><span><i class="icon-star"></i><i class="icon-star"></i><i
                                                    class="icon-star"></i><i class="icon-star"></i><i
                                                    class="icon-star-o"></i> 30 Ratings</span></p>
                                </label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                <label class="form-check-label" for="exampleCheck1">
                                    <p class="rate"><span><i class="icon-star"></i><i class="icon-star"></i><i
                                                    class="icon-star"></i><i class="icon-star-o"></i><i
                                                    class="icon-star-o"></i> 5 Ratings</span></p>
                                </label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                <label class="form-check-label" for="exampleCheck1">
                                    <p class="rate"><span><i class="icon-star"></i><i class="icon-star"></i><i
                                                    class="icon-star-o"></i><i class="icon-star-o"></i><i
                                                    class="icon-star-o"></i> 0 Ratings</span></p>
                                </label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                <label class="form-check-label" for="exampleCheck1">
                                    <p class="rate"><span><i class="icon-star"></i><i class="icon-star-o"></i><i
                                                    class="icon-star-o"></i><i class="icon-star-o"></i><i
                                                    class="icon-star-o"></i> 0 Ratings</span></p>
                                </label>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-12 room-single ftco-animate mb-5 mt-5">
                <h4 class="mb-4">Available Room</h4>
                <div class="row">
                    <div class="col-sm col-md-6 ftco-animate">
                        <div class="room">
                            <a href="rooms.html" class="img img-2 d-flex justify-content-center align-items-center"
                               style="background-image: url(images/room-1.jpg);">
                                <div class="icon d-flex justify-content-center align-items-center">
                                    <span class="icon-search2"></span>
                                </div>
                            </a>
                            <div class="text p-3 text-center">
                                <h3 class="mb-3"><a href="rooms.html">Suite Room</a></h3>
                                <p><span class="price mr-2">$120.00</span> <span class="per">per night</span></p>
                                <hr>
                                <p class="pt-1"><a href="room-single.html" class="btn-custom">View Room Details <span
                                                class="icon-long-arrow-right"></span></a></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm col-md-6 ftco-animate">
                        <div class="room">
                            <a href="rooms.html" class="img img-2 d-flex justify-content-center align-items-center"
                               style="background-image: url(images/room-2.jpg);">
                                <div class="icon d-flex justify-content-center align-items-center">
                                    <span class="icon-search2"></span>
                                </div>
                            </a>
                            <div class="text p-3 text-center">
                                <h3 class="mb-3"><a href="rooms.html">Family Room</a></h3>
                                <p><span class="price mr-2">$20.00</span> <span class="per">per night</span></p>
                                <hr>
                                <p class="pt-1"><a href="room-single.html" class="btn-custom">View Room Details <span
                                                class="icon-long-arrow-right"></span></a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <style>
        .rule{
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
            box-shadow: 0 0 4px 0 rgba(0,0,0,1);
            cursor: pointer;
            -webkit-appearance: none;
            margin-top: -8px;
        }
        input[type=range]:focus::-webkit-slider-runnable-track {
            background: #03a9f4;
        }
    </style>
@endsection
@section('js')
    <script>
        function modifyOffset() {
            var el, newPoint, newPlace, offset, siblings, k;
            width    = this.offsetWidth;
            newPoint = (this.value - this.getAttribute("min")) / (this.getAttribute("max") - this.getAttribute("min"));
            offset   = -1;
            if (newPoint < 0) { newPlace = 0;  }
            else if (newPoint > 1) { newPlace = width; }
            else { newPlace = width * newPoint + offset; offset -= newPoint;}
            siblings = this.parentNode.childNodes;
            for (var i = 0; i < siblings.length; i++) {
                sibling = siblings[i];
                if (sibling.id == this.id) { k = true; }
                if ((k == true) && (sibling.nodeName == "OUTPUT")) {
                    outputTag = sibling;
                }
            }
            outputTag.style.left       = newPlace + "px";
            outputTag.style.marginLeft = offset + "%";
            outputTag.innerHTML        = this.value + "h";
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
    </script>
@endsection
