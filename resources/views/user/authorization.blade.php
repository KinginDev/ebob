@extends('layout')
@section('content')
    <div class="get-in-touch-area cotnact-page">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="contact-form-wrapper">

                        @if(Auth::user()->status == 0)

                            <h2 class=" text-center text-danger"> Your Account Has been Blocked</h2><br>
                        @else


                        <div class="panel panel-primary panel-custom">
                            <div class="panel-heading text-center">
                                <h4 class="name text-uppercase">{{$page_title}} </h4>
                            </div>
                            @if(Auth::user()->email_verify == 0 && Auth::user()->phone_verify == 0)
                                <div class="panel-body">
                                    <form class="row controls" method="POST"
                                          action="{{route('user.send-emailVcode') }}">
                                        @csrf
                                        <div class="col-md-8 col-md-offset-2">
                                            <div class="form-element margin-bottom-30">
                                                <input type="hidden" name="id" value="{{Auth::user()->id}}">
                                                <p>Your E-mail Address:<strong> {{Auth::user()->email}}</strong></p>
                                                <button type="submit"
                                                        class="btn btn-block btn-lg custom-sbtn btn-primary">Send
                                                    Code
                                                </button>

                                            </div>
                                        </div>
                                    </form>
                                    <form class="row controls" method="POST" action="{{ route('user.email-verify')}}">
                                        @csrf
                                        <div class="col-md-8 col-md-offset-2">
                                            <div class="form-element margin-bottom-30">
                                                <input type="hidden" name="id" value="{{Auth::user()->id}}">
                                                <div class="form-group">
                                                    <input name="email_code" type="text"
                                                           placeholder="Enter  Code"
                                                           class="input-field" required autofocus>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit"
                                                        class="btn btn-block custom-sbtn btn-lg btn-primary">Submit
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                            @elseif(Auth::user()->email_verify == 0)
                                <form class="row controls" method="POST" action="{{route('user.send-emailVcode') }}">
                                    @csrf
                                    <div class="col-md-8 col-md-offset-2">
                                        <div class="form-element margin-bottom-30">
                                            <div class="margin-top-20"></div>
                                            <input type="hidden" name="id" value="{{Auth::user()->id}}">
                                            <p>Your E-mail Address:<strong> {{Auth::user()->email}}</strong></p>

                                            <div class="form-group">
                                                <button type="submit"
                                                        class="btn btn-block custom-sbtn btn-lg btn-primary">Send
                                                    Code
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                </form>

                                <form class="row controls" method="POST" action="{{ route('user.email-verify')}}">
                                    @csrf
                                    <div class="col-md-8 col-md-offset-2">
                                        <div class="form-element margin-bottom-30">
                                            <input type="hidden" name="id" value="{{Auth::user()->id}}">
                                            <div class="form-group">
                                                <input name="email_code" type="text" placeholder="Enter  Code"
                                                       class="input-field" required
                                                       autofocus>
                                            </div>

                                            <div class="form-group">
                                                <button type="submit"
                                                        class="btn btn-block custom-sbtn btn-lg btn-primary">
                                                    Submit
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>



                            @elseif(Auth::user()->phone_verify == 0)
                                <form class="row controls" method="POST" action="{{route('user.send-vcode') }}">
                                    @csrf
                                    <div class="col-md-8 col-md-offset-2">
                                        <div class="form-element margin-bottom-30">
                                            <div class="margin-top-20"></div>
                                            <input type="hidden" name="id" value="{{Auth::user()->id}}">
                                            <p>Your Mobile No:<strong> {{Auth::user()->phone}}</strong></p>

                                            <div class="form-group">
                                                <button type="submit"
                                                        class="btn btn-block btn-lg custom-sbtn btn-primary">
                                                    Send Code
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>


                                <form class="row controls" method="POST" action="{{ route('user.sms-verify')}}">
                                    @csrf
                                    <div class="col-md-8 col-md-offset-2">

                                        <div class="form-element margin-bottom-30">
                                            <input type="hidden" name="id" value="{{Auth::user()->id}}">
                                            <div class="form-group">
                                                <input name="sms_code" type="text" placeholder="Enter  Code"
                                                       class="input-field" required
                                                       autofocus>
                                            </div>

                                            <div class="form-group">
                                                <button type="submit"
                                                        class="btn btn-lg custom-sbtn btn-block btn-primary">Submit
                                                </button>
                                            </div>
                                        </div>

                                    </div>
                                </form>

                            @endif


                        </div>


                            @endif



                    </div>
                </div>
            </div>
        </div>
    </div>



@stop