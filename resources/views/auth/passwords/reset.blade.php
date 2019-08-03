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
                        @if (session()->has('message'))
                            <div class="alert alert-{{ session()->get('type') }} alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;
                                </button>
                                {{ session()->get('message') }}
                            </div>
                        @endif
                        @if (session()->has('status'))
                            <div class="alert alert-danger alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;
                                </button>
                                {{ session()->get('status') }}
                            </div>
                    @endif
                        <!-- content form wrapper -->
                        <form method="POST" action="{{ route('user.password.request') }}" id="get_in_touch">
                            {{csrf_field()}}
                            <div class="row">


                                <div class="col-lg-12">
                                    <div class="form-element has-icon margin-bottom-20">
                                        <input type="hidden" name="token" value="{{ $token }}">
                                        <input type="text" name="email" id="email" value="{{$email}}" class="input-field" readonly>
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
                                        <input type="password" name="password" id="password"
                                               class="input-field @if($errors->has('password')) error  @endif"
                                               placeholder="Password">
                                        <div class="the-icon"> <i class="fas fa-key"></i> </div>
                                        @if ($errors->has('password'))
                                            <span class="error ">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-element has-icon margin-bottom-20">
                                        <input type="password" name="password_confirmation" class="input-field" placeholder="Confirm Password">
                                        <div class="the-icon">
                                            <i class="fas fa-key"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="form-element   margin-bottom-20"></div>
                                    <div class="form-element  margin-bottom-20">
                                        <input type="submit" value="Reset Password " class="submit-btn btn-block">
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
