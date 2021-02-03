@extends('frontend.layouts.sidebar')
@section('title')
    Khách sạn
@endsection
@section('content')
    <div class="col-md-4 ftco-animate">
        <div class="project-wrap hotel">
            <a href="#" class="img" style="background-image: url(images/hotel-resto-1.jpg);">
                <span class="price">$200/person</span>
            </a>
            <div class="text p-4">
                <p class="star mb-2">
                    <span class="fa fa-star"></span>
                    <span class="fa fa-star"></span>
                    <span class="fa fa-star"></span>
                    <span class="fa fa-star"></span>
                    <span class="fa fa-star"></span>
                </p>
                <span class="days">8 Days Tour</span>
                <h3><a href="#">Manila Hotel</a></h3>
                <p class="location"><span class="fa fa-map-marker"></span> Manila, Philippines</p>
                <ul>
                    <li><span class="flaticon-shower"></span>2</li>
                    <li><span class="flaticon-king-size"></span>3</li>
                    <li><span class="flaticon-mountains"></span>Near Mountain</li>
                </ul>
            </div>
        </div>
    </div>
@endsection
@section('js')
@endsection
