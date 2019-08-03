@extends('layout')
@section('css')
    <style>
        .section-title {
            margin-bottom: 0px;
        }
    </style>
    @stop
@section('content')


    <!-- our attorney area start -->
    <section class="about-us-aera about-page">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2">
                    <div class="section-title text-center">
                        <h2 class="title">
                            <strong>{{$page_title}}</strong>
                        </h2>
                        <div class="separator ">
                            <img src="{{asset('assets/images/logo/favicon.png')}}" alt="separator image">
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 ">
                    <div class="section-title ">
                        <p class="description">
                            {!! $menu->description !!}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- our attorney area end -->
    @include('partials.get-contact')

@stop