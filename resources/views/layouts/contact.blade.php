@extends('layout')
@section('content')
<!-- contact info area start -->
<div class="contact-info-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-6 col-rm-6">
                <div class="single-contact-info-box rmb-30 contact-info-min-height"><!-- single contact info box -->
                    <div class="bt-icon one"><i class="pe-7s-call"></i></div>
                    <h4 class="title">phone</h4>
                    <span class="list">{{$basic->phone}}</span>
                </div><!-- //.single contact info box -->
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-rm-6">
                <div class="single-contact-info-box rmb-30 contact-info-min-height"><!-- single contact info box -->
                    <div class="bt-icon two"><i class="pe-7s-mail-open-file"></i></div>
                    <h4 class="title">Email</h4>
                    <span class="list">{{$basic->email}}</span>
                </div><!-- //.single contact info box -->
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-rm-6">
                <div class="single-contact-info-box contact-info-min-height"><!-- single contact info box -->
                    <div class="bt-icon three"><i class="pe-7s-map-marker"></i></div>
                    <h4 class="title">Location</h4>
                    @php
                        $split = explode(" ",  $basic->address);
                    $lastSpacePosition = strrpos($basic->address," ");
                    $textWithoutLastWord =substr($basic->address,0,$lastSpacePosition);
                    @endphp
                    <span class="list">{!! $textWithoutLastWord !!}</span>
                    <span class="list">{!! $split[count($split)-1] !!}</span>
                </div><!-- //.single contact info box -->
            </div>
        </div>
    </div>
</div>
<!-- contact info area end -->

<!-- map area start -->
<div class="map-wrapper" id="map" data-lag="{{$basic->latitude}}" data-loge="{{$basic->longitude}}"></div>
<!-- map area end -->

<!-- get in touch area start -->
<div class="get-in-touch-area cotnact-page">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 remove-col-padding">
                <div class="contact-form-wrapper">
                    <!-- content form wrapper -->
                    <form action="{{route('contact.submit')}}" method="post" id="get_in_touch">
                        {{csrf_field()}}
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-element has-icon margin-bottom-20">
                                    <input type="text" name="name" class="input-field @if($errors->has('name')) error  @endif" id="uname" placeholder="Name">
                                    <div class="the-icon">
                                        <i class="fas fa-user"></i>
                                    </div>
                                </div>
                                <div class="form-element has-icon margin-bottom-20">
                                    <input type="text" name="phone" id="phone" class="input-field @if($errors->has('phone')) error  @endif" placeholder="Phone">
                                    <div class="the-icon">
                                        <i class="fas fa-phone"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-element has-icon margin-bottom-20">
                                    <input type="email" name="email" id="email" class="input-field @if($errors->has('email')) error  @endif" placeholder="Email">
                                    <div class="the-icon">
                                        <i class="far fa-envelope"></i>
                                    </div>
                                </div>
                                <div class="form-element has-icon margin-bottom-20">
                                    <input type="text" name="subject" id="subject" class="input-field @if($errors->has('subject')) error  @endif" placeholder="Subject">
                                    <div class="the-icon">
                                        <i class="fas fa-book"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-element has-icon textarea margin-bottom-20">
                                    <textarea id="message" name="message" cols="30" rows="10" class="input-field textarea @if($errors->has('message')) error  @endif"></textarea>
                                    <div class="the-icon">
                                        <i class="fas fa-pencil-alt"></i>
                                    </div>
                                </div>
                                <input type="submit" value="Submit" class="submit-btn btn-block">
                            </div>
                        </div>
                    </form>
                </div>
                <!-- //.content form wrapper -->
            </div>
        </div>
    </div>
</div>
<!-- get in touch area end -->
@endsection


@section('script')
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDi-rrw9lb-uKY1vHd9gkzuBpj4-hiBsUA&callback=initMap" async
            defer></script>
    <!-- google map activate js -->
    <script src="{{asset('assets/front/js/google-map-activate.js')}}"></script>
@endsection