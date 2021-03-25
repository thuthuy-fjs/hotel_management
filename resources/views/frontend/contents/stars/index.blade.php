@extends('frontend.layouts.sidebar')
@section('title')
    Đơn đặt phòng
@endsection
@section('content')
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h4 class="mb-0">Đánh giá của bạn</h4>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="col-lg-12">
                            @if(count($star_ratings) > 0)
                                <table class="table table-border">
                                    <thead>
                                    <tr>
                                        <th>Khách sạn</th>
                                        <th>Phòng</th>
                                        <th>Đánh giá</th>
                                        <th>Mô tả</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($star_ratings as $star_rating)
                                        <tr>
                                            <td>{{$star_rating->booking->room->hotel->hotel_name}}</td>
                                            <td>{{$star_rating->booking->room->room_name}}</td>
                                            <td>
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
                                            </td>
                                            <td>
                                                {{$star_rating->description}}
                                            </td>

                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                {{$star_ratings->links()}}
                            @else
                                <div class="container">
                                    <div class="row">
                                        <div class="col-sm-12 text-center">
                                            <section class='alert alert-success'>Bạn chưa có đánh giá nào!</section>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
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
    </style>
@endsection
@section('js')
@endsection
