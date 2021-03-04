@extends('frontend.layouts.app')
@section('title')
    Khách sạn thuộc tỉnh {{$province_name->province_name}}
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
                                            <option value="{{ $province->id }}">{{ $province->province_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <input type="text" id="check_in_date" name="check_in_date"
                                           class="form-control checkin_date"
                                           placeholder="Nhận phòng">
                                </div>
                                <div class="form-group">
                                    <input type="text" id="check_out_date" name="check_out_date"
                                           class="form-control checkout_date"
                                           placeholder="Trả phòng">
                                </div>
                                <div class="form-group">
                                    <div class="select-wrap one-third">
                                        <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                                        <select name="person_number" id="person_number" class="form-control">
                                            <option value="">1 người</option>
                                            <option value="">2 người</option>
                                            <option value="">3 người</option>
                                            <option value="">4 người</option>
                                            <option value="">5 người</option>
                                            <option value="">6 người</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="submit" value="Search" class="btn btn-primary py-3 px-5">
                                </div>
                            </div>
                        </form>
                    </div>
                    <hr>
                    <div class="sidebar-wrap bg-light ftco-animate">
                        <h3 class="heading mb-4">Các bộ lọc phổ biến</h3>
                        <form method="post" class="star-rating">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                <label class="form-check-label" for="exampleCheck1">
                                    <p class="rate"><span>Khách sạn</span></p>
                                </label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                <label class="form-check-label" for="exampleCheck1">
                                    <p class="rate"><span>Căn hộ</span></p>
                                </label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                <label class="form-check-label" for="exampleCheck1">
                                    <p class="rate"><span>Resort</span></p>
                                </label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                <label class="form-check-label" for="exampleCheck1">
                                    <p class="rate"><span>Nhà nghỉ</span></p>
                                </label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                <label class="form-check-label" for="exampleCheck1">
                                    <p class="rate"><span>Biệt thự</span></p>
                                </label>
                            </div>
                        </form>
                    </div>
                    <hr>
                    <div class="sidebar-wrap bg-light ftco-animate">
                        <h3 class="heading mb-4">Xếp hạng sao</h3>
                        <form method="post" class="star-rating">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                <label class="form-check-label" for="exampleCheck1">
                                    <p class="rate"><span><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                                    class="bi bi-star-fill"></i><i
                                                    class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i></span>
                                    </p>
                                </label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                <label class="form-check-label" for="exampleCheck1">
                                    <p class="rate"><span><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                                    class="bi bi-star-fill"></i><i
                                                    class="bi bi-star-fill"></i><i class="bi bi-star"></i></span></p>
                                </label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                <label class="form-check-label" for="exampleCheck1">
                                    <p class="rate"><span><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                                    class="bi bi-star-fill"></i><i
                                                    class="bi bi-star"></i><i class="bi bi-star"></i></span></p>
                                </label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                <label class="form-check-label" for="exampleCheck1">
                                    <p class="rate"><span><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                                    class="bi bi-star"></i><i class="bi bi-star"></i><i
                                                    class="bi bi-star"></i></span></p>
                                </label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                <label class="form-check-label" for="exampleCheck1">
                                    <p class="rate"><span><i class="bi bi-star-fill"></i><i class="bi bi-star"></i><i
                                                    class="bi bi-star"></i><i class="bi bi-star"></i><i
                                                    class="bi bi-star"></i></span></p>
                                </label>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="row">
                        @foreach($province_name->hotels as $hotel)
                            <div class="col-md-6 ftco-animate">
                                <div class="project-wrap hotel">
                                    <a href="{{route('hotel', ['id='.$hotel->id,'province='.$province_name->id, 'check_in_date='.$check_in_date, 'check_out_date='.$check_out_date, 'person_number='.$person_number])}}"
                                       class="img"
                                       style="background-image: url({{$hotel->hotel_image}});">
                                        <span class="price">{{$hotel->hotel_name}}</span>
                                    </a>
                                    <div class="text p-4" style="height: 230px;">
                                        <h3>
                                            <a href="{{route('hotel', ['id='.$hotel->id,'province='.$province_name->id, 'check_in_date='.$check_in_date, 'check_out_date='.$check_out_date, 'person_number='.$person_number])}}">Khách
                                                sạn {{$hotel->hotel_name}}</a>
                                        </h3>
                                        <p class="location"><span
                                                    class="fa fa-map-marker"></span> {{$hotel->province->province_name}}
                                        </p>
                                        <ul>
                                            <li>{{$hotel->hotel_email}}</li>
                                            <br>
                                            <li>{{$hotel->hotel_phone}}</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
@section('js')
@endsection
