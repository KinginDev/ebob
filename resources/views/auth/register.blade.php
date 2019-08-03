@extends('layout')
@section('content')
    <!-- get in touch area start -->
    <div class="get-in-touch-area cotnact-page">
        <div class="container">
            <div class="row">
                @if($basic->registration == 0)
                    <div class="col-lg-10 col-md-offset-1 remove-col-padding">
                        <div class="section-title text-center">
                            <h2 class="title">
                                <strong> {{$page_title}} Has been Deactivated By Admin</strong>
                            </h2>
                        </div>
                    </div>

                @else
                    <div class="col-lg-6 col-md-offset-3 remove-col-padding">
                        <div class="section-title text-center">
                            <h2 class="title">
                                <strong> Register</strong>
                            </h2>
                        </div>
                        <div class="contact-form-wrapper">
                            <!-- content form wrapper -->
                            <form method="POST" action="{{ route('register') }}" id="get_in_touch">
                                {{csrf_field()}}
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-element has-icon margin-bottom-20">
                                            <input type="text" name="name"
                                                   class="input-field @if($errors->has('name')) error  @endif"
                                                   id="name" placeholder="Enter Your Name"  value="{{ old('name') }}"> 
                                            <div class="the-icon">
                                                <i class="fas fa-user "></i>
                                            </div>

                                            @if ($errors->has('name'))
                                                <span class="error ">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="form-element has-icon margin-bottom-20">
                                            <input type="text" name="username"
                                                   class="input-field @if($errors->has('username')) error  @endif"
                                                   id="uname" placeholder="Username"  value="{{ old('username') }}">
                                            <div class="the-icon">
                                                <i class="fas fa-user"></i>
                                            </div>

                                            @if ($errors->has('username'))
                                                <span class="error">
                                                <strong>{{ $errors->first('username') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="form-element has-icon margin-bottom-20">
                                            <input type="email" name="email"
                                                   class="input-field @if($errors->has('email')) error  @endif"
                                                   id="email" placeholder="Enter Your Email"  value="{{ old('email') }}">
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
                                        <div class="form-element has-icon margin-bottom-20">
                                            <input type="text" name="phone"
                                                   class="input-field @if($errors->has('phone')) error  @endif"
                                                   id="phone" placeholder="Contact Number"  value="{{ old('phone') }}">
                                            <div class="the-icon">
                                                <i class="fas fa-phone"></i>
                                            </div>

                                            @if ($errors->has('phone'))
                                                <span class="error ">
                                                <strong>{{ $errors->first('phone') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>


                                    <div class="col-lg-12">
                                        <div class="form-element has-icon margin-bottom-20">
                                            <input type="password" name="password" id="password"
                                                   class="input-field @if($errors->has('password')) error  @endif"
                                                   placeholder="Password"  >
                                            <div class="the-icon"><i class="fas fa-key"></i></div>
                                            @if ($errors->has('password'))
                                                <span class="error ">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-element has-icon margin-bottom-20">
                                            <input type="password" name="password_confirmation" class="input-field"
                                                   placeholder="Re-enter Password">
                                            <div class="the-icon">
                                                <i class="fas fa-key"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="form-element   margin-bottom-20"></div>
                                        <div class="form-element  margin-bottom-20">
                                            <input type="submit" value="Sign In" class="submit-btn btn-block">
                                        </div>
                                        <span>Already have an account ? <a href="{{route('login')}}"> Sign Up</a></span>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- //.content form wrapper -->
                    </div>

                @endif
            </div>
        </div>
    </div>
    <!-- get in touch area end -->


@endsection
