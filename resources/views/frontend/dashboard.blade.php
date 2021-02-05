@extends('frontend.layouts.dashboard')
@section('title')
    Pacific
@endsection
@section('content')
    <section class="ftco-section ftco-no-pb ftco-no-pt">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="ftco-search d-flex justify-content-center">
                        <div class="row">
                            <div class="col-md-12 nav-link-wrap">
                                <div class="nav nav-pills text-center" id="v-pills-tab" role="tablist"
                                     aria-orientation="vertical">
                                    <a class="nav-link active mr-md-1" id="v-pills-1-tab" data-toggle="pill"
                                       href="#v-pills-1" role="tab" aria-controls="v-pills-1" aria-selected="true">Tìm
                                        kiếm</a>
                                </div>
                            </div>
                            <div class="col-md-12 tab-wrap">
                                <div class="tab-content" id="v-pills-tabContent">
                                    <div class="tab-pane fade show active" id="v-pills-1" role="tabpanel"
                                         aria-labelledby="v-pills-nextgen-tab">
                                        <form action="{{route('search')}}" method="get" class="search-property-1">
                                            @csrf
                                            <div class="row no-gutters">
                                                <div class="col-md d-flex">
                                                    <div class="form-group p-4 border-0">
                                                        <label for="#">Địa điểm</label>
                                                        <div class="form-field">
                                                            <div class="icon"><span class="fa fa-search"></span></div>
                                                            <input type="text" class="form-control"
                                                                   placeholder="Địa điểm">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md d-flex">
                                                    <div class="form-group p-4">
                                                        <label for="#">Nhận phòng</label>
                                                        <div class="form-field">
                                                            <div class="icon"><span class="fa fa-calendar"></span></div>
                                                            <input type="text" class="form-control checkin_date"
                                                                   placeholder="Check In">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md d-flex">
                                                    <div class="form-group p-4">
                                                        <label for="#">Trả phòng</label>
                                                        <div class="form-field">
                                                            <div class="icon"><span class="fa fa-calendar"></span></div>
                                                            <input type="text" class="form-control checkout_date"
                                                                   placeholder="Check Out">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md d-flex">
                                                    <div class="form-group p-4">
                                                        <label for="#">Số người</label>
                                                        <div class="form-field">
                                                            <div class="select-wrap">
                                                                <div class="icon"><span
                                                                            class="fa fa-chevron-down"></span></div>
                                                                <select name="" id="" class="form-control">
                                                                    <option value="">1</option>
                                                                    <option value="">2</option>
                                                                    <option value="">3</option>
                                                                    <option value="">4</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md d-flex">
                                                    <div class="form-group d-flex w-100 border-0">
                                                        <div class="form-field w-100 align-items-center d-flex">
                                                            <input type="submit" value="Tìm kiếm"
                                                                   class="align-self-stretch form-control btn btn-primary">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="ftco-section services-section">
        <div class="container">
            <div class="row d-flex">
                <div class="col-md-6 order-md-last heading-section pl-md-5 ftco-animate d-flex align-items-center">
                    <div class="w-100">
                        <span class="subheading">Welcome to Pacific</span>
                        <h2 class="mb-4">Khám phá Việt Nam</h2>
                        <p>Khắp đất nước Việt Nam là những danh lam thắng cảnh, những di sản thế giới được cả thế giới
                            biết đến. Vẻ đẹp Việt Nam luôn là niềm tự hào của cả dân tộc, với các danh lam thắng cảnh
                            nổi tiếng ở Việt Nam, ngành du lịch ngày càng phát triển, khách du lịch quốc tế đến với Việt
                            Nam tăng nhanh qua mỗi năm...</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-12 col-lg-6 d-flex align-self-stretch ftco-animate">
                            <div class="services services-1 color-1 d-block img"
                                 style="background-image: url({{asset('frontend_assets/images/services-3.jpg')}});">
                                <div class="icon d-flex align-items-center justify-content-center"><span
                                            class="flaticon-paragliding"></span></div>
                                <div class="media-body">
                                    <h3 class="heading mb-3">Di tích</h3>
                                    <p>Tính đến năm 2020, Việt Nam có hơn 41.000 di tích, thắng cảnh</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-6 d-flex align-self-stretch ftco-animate">
                            <div class="services services-1 color-2 d-block img"
                                 style="background-image: url({{asset('frontend_assets/images/services-1.jpg')}});">
                                <div class="icon d-flex align-items-center justify-content-center"><span
                                            class="flaticon-route"></span></div>
                                <div class="media-body">
                                    <h3 class="heading mb-3">Danh thắng</h3>
                                    <p>Việt Nam đứng thứ 27 trong số 156 quốc gia có biển trên thế giới với 125 bãi tắm
                                        biển, hầu hết là các bãi tắm đẹp</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-6 d-flex align-self-stretch ftco-animate">
                            <div class="services services-1 color-3 d-block img"
                                 style="background-image: url({{asset('frontend_assets/images/anh1.jpg')}});">
                                <div class="icon d-flex align-items-center justify-content-center"><span
                                            class="flaticon-tour-guide"></span></div>
                                <div class="media-body">
                                    <h3 class="heading mb-3">Lễ hội Việt Nam</h3>
                                    <p>Theo thống kê vào 2009, hiện cả nước Việt Nam có 7.966 lễ hội</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-6 d-flex align-self-stretch ftco-animate">
                            <div class="services services-1 color-4 d-block img"
                                 style="background-image: url({{asset('frontend_assets/images/anh2.png')}});">
                                <div class="icon d-flex align-items-center justify-content-center"><span
                                            class="flaticon-map"></span></div>
                                <div class="media-body">
                                    <h3 class="heading mb-3">Văn hóa</h3>
                                    <p>Ngành du lịch và các địa phương Việt Nam đã nỗ lực xây dựng được một số điểm du
                                        lịch độc đáo</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section img ftco-select-destination"
             style="background-image: url({{asset('frontend_assets/images/bg_3.jpg')}});">
        <div class="container">
            <div class="row justify-content-center pb-4">
                <div class="col-md-12 heading-section text-center ftco-animate">
                    <h2 class="mb-4">Chọn địa điểm</h2>
                </div>
            </div>
        </div>
        <div class="container container-2">
            <div class="row">
                <div class="col-md-12">
                    <div class="carousel-destination owl-carousel ftco-animate">
                        @foreach($provinces as $province)
                            <div class="item">
                                <div class="project-destination">
                                    <a href="{{route('search.province', $province->id)}}" class="img" style="background-image: url({{asset($province->province_image)}});">
                                        <div class="text">
                                            <h3>{{$province->province_name}}</h3>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="ftco-section img ftco-select-destination">
        <div class="container">
            <div class="row justify-content-center pb-4">
                <div class="col-md-12 heading-section text-center ftco-animate">
                    <h2 class="mb-4">Tìm kiếm theo loại chỗ nghỉ</h2>
                </div>
            </div>
        </div>
        <div class="container container-2">
            <div class="row">
                <div class="col-md-12">
                    <div class="carousel-destination owl-carousel ftco-animate">
                        @foreach($categories as $category)
                            <div class="item">
                                <div class="project-destination">
                                    <a href="{{route('search.category', $category->id)}}" class="img"
                                       style="background-image: url({{asset($category->category_image)}});">
                                        <div class="text">
                                            <h3>{{$category->category_name}}</h3>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section services-section">
        <div class="container">
            <div class="row justify-content-center pb-4">
                <div class="col-md-12 heading-section text-left ftco-animate">
                    <h2 class="mb-4">Khám phá</h2>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ul class="list-unstyled list-group-flush clearfix" style="display: list-item;text-align: -webkit-match-parent;">
                        @foreach($countries as $country)
                            <a class="list-group-item h-25 w-25 p-3" href="{{route('search.country', $country->id)}}" style="padding: 0 5px 0 0;margin: 10px 0 0;list-style: none; float: left">{{$country->country_name}}</a>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section ftco-about img"
             style="background-image: url({{asset('frontend_assets/images/bg_4.jpg')}});">
        <div class="overlay"></div>
        <div class="container py-md-5">
            <div class="row py-md-5">
                <div class="col-md d-flex align-items-center justify-content-center">
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section ftco-about ftco-no-pt img">
        <div class="container">
            <div class="row d-flex">
                <div class="col-md-12 about-intro">
                    <div class="row">
                        <div class="col-md-6 d-flex align-items-stretch">
                            <div class="img d-flex w-100 align-items-center justify-content-center"
                                 style="background-image:url({{asset('frontend_assets/images/tn1.jpg')}});">
                            </div>
                        </div>
                        <div class="col-md-6 pl-md-5 py-5">
                            <div class="row justify-content-start pb-3">
                                <div class="col-md-12 heading-section ftco-animate">
                                    <span class="subheading">About Us</span>
                                    <p>Tìm kiếm nhanh hơn khách sạn, phòng nghỉ và còn nhiều hơn nữa ...</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
@section('js')
@endsection
