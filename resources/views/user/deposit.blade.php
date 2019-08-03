@extends('user')
@section('content')
    <!-- get in touch area start -->
    <div class="get-in-touch-area cotnact-page">
        <div class="container">

            @include('errors.error')
            <div class="row">
                <div class="col-md-12 remove-col-padding">
                    <div class="section-title text-center">
                        <h2 class="title">
                            <strong> {{$page_title}}</strong>
                        </h2>
                    </div>

                @foreach($gates as $gate)
                    <div class="col-lg-3 col-md-3 col-sm-6">
                        <div class="panel panel-primary panel-custom text-center"><!-- single pricing table -->
                            <div class="panel-heading ">
                                <h4 class="name">{{$gate->name}} </h4>
                            </div>
                            <div class="panel-body">
                                        <img class="card-img-top" src="{{asset('assets/images/gateway')}}/{{$gate->id.'.jpg'}}" alt="image">

                            </div>
                            <div class="panel-footer ">
                                <button data-toggle="modal"
                                        data-target="#depositModal{{$gate->id}}" class="custom-sbtn btn btn-primary btn-lg btn-block">Select</button>
                            </div>
                        </div>
                        <br>
                    </div>


                    <div id="depositModal{{$gate->id}}" class="modal fade" role="dialog">
                        <div class="modal-dialog">

                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Deposit via <strong>{{$gate->name}}</strong></h4>
                                </div>

                                <form method="post" action="{{route('deposit.data-insert')}}">
                                    <div class="modal-body">
                                        {{csrf_field()}}

                                        <input type="hidden" name="gateway" value="{{$gate->id}}">
                                        <label class="col-md-12 modal-msg-heading"><strong>DEPOSIT AMOUNT</strong>
                                            <span class="modal-msg">({{ $gate->minamo }} - {{$gate->maxamo }}) {{$basic->currency}}
                                                <br>
                                                Charged {{ $gate->fixed_charge }} {{$basic->currency}} + {{ $gate->percent_charge }}
                                                %</span>
                                        </label>
                                        <hr/>
                                        <div class="form-group">

                                            <div class="input-group">
                                                <input id="amount" type="text" class="form-control input-lg" name="amount" placeholder=" Enter Amount" required>
                                                <span class="input-group-addon">{{$basic->currency}}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary ">Preview</button>
                                        <button type="button" class="btn btn-default " data-dismiss="modal">Close
                                        </button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                @endforeach
                <!-- New Div  -->
                
                </div>
            </div>
        </div>
    </div>
    <!-- get in touch area end -->

@stop