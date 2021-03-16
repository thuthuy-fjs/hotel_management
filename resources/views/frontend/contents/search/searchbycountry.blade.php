@extends('frontend.layouts.app')
@section('title')
    {{$country->country_name}}
@endsection
@section('content')
    <div style="margin-top: 50px">
        <h2 class="text-center">{{$country->country_name}}</h2>
    </div>
    <section class="ftco-section bg-light">

        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        @foreach($country->provinces as $province)
                            <div class="col-md-4 ftco-animate">
                                <div class="project-wrap hotel">
                                    <a href="{{route('search.province', $province->id)}}" class="img" style="background-image: url({{$province->province_image}});">
                                        <span class="price">{{$province->province_name}}</span>
                                    </a>
                                    <div class="text p-4">
                                    <p>{{$country->country_name}}</p>
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
