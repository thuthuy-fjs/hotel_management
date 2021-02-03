@extends('frontend.layouts.sidebar')
@section('title')
    {{$category->category_name}}
@endsection
@section('content')
    @foreach($category->hotels as $hotel)
        <div class="col-md-4 ftco-animate">
            <div class="project-wrap hotel">
                <a href="#" class="img" style="background-image: url({{$hotel->hotel_image}});">
                    <span class="price">{{$hotel->hotel_name}}</span>
                </a>
                <div class="text p-4">
                    <h3><a href="#">Khách sạn {{$hotel->hotel_name}}</a></h3>
                    <p class="location"><span class="fa fa-map-marker"></span> {{$hotel->province->province_name}}</p>
                    <ul>
                        <li>{{$hotel->hotel_email}}</li>
                        <li>{{$hotel->hotel_phone}}</li>
                    </ul>
                </div>
            </div>
        </div>
    @endforeach
@endsection
@section('js')
@endsection
