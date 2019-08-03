@extends('user')
@section('content')
    @include('partials.breadcrumb')
    <section class="maining-area section-bg-1">
        <div class="container">

            <div class="row">
                <div class="col-md-10 offset-md-1 ">
                    <div class="card panel-bg">
                        <!-- panel head -->
                        <div class="card-header">
                            <div class="col-md-9">
                                <h4 class="card-titletext-uppercase pull-left"><i class="fa fa-money"></i>
                                    <strong>  {{$plan->title}} {{$page_title}}</strong></h4>
                            </div>

                            <div class="col-md-2">
                                <a href="{{ URL::previous() }}"
                                   class="btn  btn-primary btn-block pull-right "><i class="fa fa-arrow-left"></i>
                                    back</a>
                            </div>

                        </div>
                        <!-- panel body -->
                        <div class="card-body">
                            <div class="text-center">
                                <h6 class="bold uppercase">Current Balance
                                    : {{Auth::user()->balance}} {{$basic->currency}}
                                    <strong></strong></h6>
                            </div>
                            <br>
                            <div class="text-center">
                                <h6 class="bold uppercase"> Purchasing {{$totalPlan}}  {{$plan->unit->name}}
                                    <strong></strong></h6>
                            </div>
                            <br>

                            <div class="text-center">
                                <h6 class="bold uppercase">Total Plan Price: {{$plan->rate}} * {{$totalPlan}}
                                    = {{number_format($totalPrice, $basic->decimal)}}  {{$basic->currency}}
                                    <strong></strong></h6>
                            </div>
                            <br>

                            <div class="text-center">
                                <h6 class="bold uppercase">Remaining Balance: {{$remainBalance}} {{$basic->currency}}
                                    <strong></strong></h6>
                            </div>

                            <hr>


                            <form method="post" action="{{route('confirmPurchase')}}">
                                {{ csrf_field() }}
                                <div class="row">
                                    <input type="hidden" name="total_plan" value="{{$totalPlan}}">
                                    <input type="hidden" name="user_id" value="{{$user_id}}">
                                    <input type="hidden" name="rate" value="{{$rate}}">
                                    <input type="hidden" name="pricing_plan_id" value="{{$pricing_plan_id}}">
                                    <input type="hidden" name="mining_id" value="{{$mining_id}}">

                                    <div class="col-md-12">
                                        <br>
                                        <button type="submit" class="btn btn-primary btn-lg bold uppercase btn-block">
                                            <i class="fa fa-send"></i> Confirm Purchase
                                        </button>
                                    </div>
                                </div>

                            </form>


                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>





@stop