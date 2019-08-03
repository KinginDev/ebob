@extends('user')
@section('content')

    <!-- get in touch area start -->
    <div class="get-in-touch-area cotnact-page">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 remove-col-padding">
                    <div class="panel panel-primary panel-custom "><!-- single pricing table -->
                        <div class="panel-heading ">
                                <h4 class="name text-uppercase inline-block" >
                                   <i class="fa fa-plus"></i> {{$page_title}}
                                </h4>
                            <div class="pull-right  btn-top-320 ">
                                <a href="{{route('escrow.list')}}" class="btn btn-success btn-md">
                                    <i class="fa fa-list"></i> My Escrow List
                                </a>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="contact-form-wrapper margin-top-80 margin-bottom-40">
                                <form action="" method="post" role="form">
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-8 col-lg-offset-2">
                                            <div class="form-element margin-bottom-30">

                                                <label><strong class="text-uppercase">Escrow to:</strong></label>
                                                <input type="text" name="username" class="input-field" placeholder="Type a valid Username">
                                                @if ($errors->has('username'))
                                                    <span class="error form-error-msg ">
                                                <strong>{{ $errors->first('username') }}</strong>
                                            </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-lg-8 col-lg-offset-2">  
                                            <div class="form-element has-icon margin-bottom-20"></div>
                                            <input type="submit" value="Next" class="submit-btn btn-block">
                                        </div>

                                    </div>
                                </form>

                            </div>
                            <!-- //.content form wrapper -->
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
    <!-- get in touch area end -->
@stop