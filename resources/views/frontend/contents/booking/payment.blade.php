@extends('frontend.layouts.app')
@section('title')
    Thanh toán
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12 text-center">
                @if(session('success'))
                    <section class='alert alert-success'>{{session('success')}}</section>
                @endif 
                @if(session('errors'))
                    <section class='alert alert-success'>{{session('message')}}</section>
                @endif 
            </div>
        </div>
    </div>
@endsection
@section('js')
@endsection
