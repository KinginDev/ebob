@extends('layout')

@section('content')
    <!-- get in touch area start -->
    <div class="get-in-touch-area cotnact-page">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-offset-3 remove-col-padding">
                    <div class="section-title text-center">
                        <h2 class="title">
                            <strong> Sign In</strong>
                        </h2>
                    </div>
                    <div class="contact-form-wrapper">

                        <!-- content form wrapper -->
                        <form method="POST" action="{{ route('login') }}" id="get_in_touch">
                            {{csrf_field()}}
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-element has-icon margin-bottom-20">
                                        <input type="text" name="username"
                                               class="input-field @if($errors->has('username')) error  @endif"
                                               id="uname" placeholder="Username"  value="{{ old('username') }}">
                                        <div class="the-icon">
                                            <i class="fas fa-user"></i>
                                        </div>

                                        @if ($errors->has('username'))
                                            <span class="error ">
                                                <strong>{{ $errors->first('username') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-element has-icon margin-bottom-20">
                                        <input type="password" name="password" id="password"
                                               class="input-field @if($errors->has('password')) error  @endif"
                                               placeholder="Password">
                                        <div class="the-icon">
                                            <i class="fas fa-key"></i>
                                        </div>
                                        @if ($errors->has('password'))
                                            <span class="error ">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-element has-icon textarea margin-bottom-20"></div>
                                    <div class="form-element has-icon textarea margin-bottom-20">
                                        <input type="submit" value="Sign In" class="submit-btn btn-block">
                                    </div>
                                    <a href="{{ route('password.request') }}">Forget Password ?</a>
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
