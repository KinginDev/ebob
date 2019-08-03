@extends('user')
@section('content')


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
                        @foreach($withdrawMethod as $gate)
                            <div class="col-md-3 col-sm-6 ">
                                <div class="panel panel-primary panel-custom">
                                    <div class="panel-heading text-center">
                                        <h4 class="name">{{$gate->name}} </h4>
                                    </div>
                                    <div class="panel-body text-center">
                                        <img src="{{asset('assets/images/')}}/{{$gate->image}}" style="width:50%;"> <br><br>
                                        <ul style="font-size: 15px;" class="list-group text-center">
                                            <li class="list-group-item">Minimum - {{$gate->withdraw_min}} {{ $basic->currency }} </li>
                                            <li class="list-group-item">Maximum - {{$gate->withdraw_max}} {{ $basic->currency }} </li>
                                            <li class="list-group-item"> Charge - {{$gate->fix}} {{ $basic->currency }}+ {{$gate->percent}}%</li>
                                            <li class="list-group-item">Processing Time - {{$gate->duration}} Days </li>
                                        </ul>
                                    </div>
                                    <div class="panel-footer">
                                        <button class="custom-sbtn btn btn-primary btn-lg btn-block" data-toggle="modal" data-target="#withdrawModal{{$gate->id}}">Select  </button>
                                    </div>
                                </div>
                            </div>
                            <!--Buy Modal -->
                            <div id="withdrawModal{{$gate->id}}" class="modal fade" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">Withdraw via <strong>{{$gate->name}}</strong></h4>
                                        </div>
                                        <div class="modal-body">
                                            <form method="POST" action="{{route('withdraw.preview') }}">
                                                {{csrf_field()}}
                                                <input type="hidden" name="method_id" value="{{$gate->id}}">
                                                <label class="col-md-12 modal-msg-heading"><strong>Limit</strong>
                                                    <span class="modal-msg">({{ $gate->withdraw_min }} - {{$gate->withdraw_max }}) {{$basic->currency}}
                                                        <br>
                                                Charge {{ $gate->fix }} {{$basic->currency}} + {{ $gate->percent }}
                                                        %</span>
                                                </label>

                                                <hr/>
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <input type="text" name="amount" class="form-control" id="amount" required>
                                                        <span class="input-group-addon">
                                                                                {{$basic->currency}}
                                                                              </span>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-primary btn-block">
                                                        Preview
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        @endforeach
                </div>
            </div>
        </div>
    </div>
    <!-- About Hostonion End -->



@stop