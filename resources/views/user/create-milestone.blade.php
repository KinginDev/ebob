@extends('user')
@section('content')

    <!-- get in touch area start -->
    <div class="get-in-touch-area cotnact-page">
        <div class="container">
            <div class="row">
                @php
                    $escrowId=  Session::get('escrowId');
                @endphp
                <div class="col-lg-12 remove-col-padding">
                    <div class="panel panel-primary panel-custom "><!-- single pricing table -->
                        <div class="panel-heading ">
                            <h4 class="name text-uppercase inline-block">
                                <i class="fa fa-money-bill"></i> {{$page_title}}
                            </h4>
                            <div class="pull-right btn-top-320">
                                <a href="{{route('escrow.list')}}" class="btn btn-success btn-md ">
                                    <i class="fa fa-list"></i> My Escrow List
                                </a>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="contact-form-wrapper margin-top-80 margin-bottom-40">



                                @if($escrowId != null)
                                    <form action="" method="post" role="form">
                                        @csrf
                                        <div class="row">

                                            <div class="col-lg-8 col-lg-offset-2">
                                                <div class="form-element margin-bottom-30">
                                                    <input type="hidden" name="escrow_id" value="{{$escrowId }}" class="input-field" placeholder="Enter Amount ">


                                                    <label><strong class="text-uppercase">Escrow Amount:</strong></label>
                                                    <div class="input-group">
                                                    <input type="text" name="amount" class="input-field"
                                                           placeholder="Enter Amount ">

                                                        <span class="input-group-addon">{{$basic->currency}}</span>
                                                    </div>

                                                    @if ($errors->has('amount'))
                                                        <span class="error form-error-msg ">
                                                            <strong>{{ $errors->first('amount') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-lg-8 col-lg-offset-2">
                                                <div class="form-element margin-bottom-30">
                                                    <label><strong class="text-uppercase">Escrow Title:</strong></label>
                                                    <input type="text" name="title" class="input-field"
                                                           placeholder="Enter Title">
                                                    @if ($errors->has('title'))
                                                        <span class="error form-error-msg ">
                                                            <strong>{{ $errors->first('title') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-lg-8 col-lg-offset-2">
                                                <div class="form-element margin-bottom-30">
                                                    <label><strong class="text-uppercase">Escrow Description :</strong></label>
                                                    <textarea name="description" class="input-field form-control" rows="5"></textarea>
                                                </div>
                                            </div>



                                            <div class="col-lg-8 col-lg-offset-2">
                                                <div class="form-element has-icon margin-bottom-20"></div>
                                                <input type="submit" value="Submit" class="submit-btn btn-block">
                                            </div>

                                        </div>
                                    </form>
                                @else

                                    <script>
                                        window.location.href = '{{route("escrow.list")}}';
                                    </script>
                                @endif

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