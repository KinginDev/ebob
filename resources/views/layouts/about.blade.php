@extends('layout')
@section('content')



    <!-- about area start -->
    <section class="about-us-aera about-page">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="left-content-area">
                        <!-- let content area -->
                        <div class="thumb">
                            <img src="{{asset('assets/images/about-video-image.jpg')}}" alt="about left image">
                            <div class="hover">
                                <a href="{!! $basic->	about_video !!}" class="mfp-iframe video-play-btn">
                                    <i class="fas fa-play"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- //. left content area -->
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="right-content-area">
                        <!-- right content area -->
                        {!! $basic->about !!}
                    </div>
                    <!-- //.right content area -->
                </div>
            </div>
        </div>
    </section>
    <!-- about area end -->



    <!-- our attorney area start -->
    <section class="our-attorney-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2">
                    <div class="section-title text-center">
                        <h2 class="title">our
                            <strong>Team</strong>
                        </h2>
                        <div class="separator ">
                            <img src="{{asset('assets/images/logo/favicon.png')}}" alt=" image">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach($ourTeams as $data)
                    <div class="col-lg-4 col-md-4 col-sm-6 col-rm-6">
                        <div class="single-attorney-box margin-bottom-30">
                            <!-- single-attorney-box -->
                            <div class="thumb">
                                <img src="{{asset('assets/images/our-team/'.$data->image)}}" alt="arrorney">
                                <div class="hover">
                                    <div class="hover-inner">
                                        <h4 class="name">{{$data->name}}</h4>
                                        <span class="post">{{$data->designation}}</span>

                                        <a href="{{$data->facebook}}" class="social-icon">
                                            <i class="fab fa-facebook-f"></i>
                                        </a>
                                        <a href="{{$data->twitter}}" class="social-icon two">
                                            <i class="fab fa-twitter"></i>
                                        </a>
                                        <a href="{{$data->linkedin}}" class="social-icon">
                                            <i class="fab fa-linkedin"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- //.single-attorney-box -->
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- our attorney area end -->


    @include('partials.clients')

@stop