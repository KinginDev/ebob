@extends('layout')

@section('content')
    <!-- get in touch area start -->
    <div class="get-in-touch-area cotnact-page">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-offset-2 remove-col-padding">
                    <div class="section-title text-center">
                        <h2 class="title">
                            <strong> {{$page_title}}</strong>
                        </h2>
                    </div>
                    <div class="contact-form-wrapper">
                        <!-- content form wrapper -->
                        <form method="POST" action="{{ route('user.password.email') }}" id="get_in_touch">
                            {{csrf_field()}}
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-element has-icon margin-bottom-20">
                                        <input type="email" name="email" id="email"
                                               class="input-field @if($errors->has('email')) error  @endif"
                                                placeholder="Enter Your Email">
                                        <div class="the-icon">
                                            <i class="fas fa-envelope"></i>
                                        </div>

                                        @if ($errors->has('email'))
                                            <span class="error ">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-element has-icon textarea margin-bottom-20"></div>
                                    <div class="form-element has-icon textarea margin-bottom-20">
                                        <input type="submit" value="Send Password Reset Link" class="submit-btn btn-block">
                                    </div>
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
