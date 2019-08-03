@extends('user')
@section('css')
    <link rel="stylesheet" href="{{asset('assets/front/css/pricing.css')}}">
@stop
@section('content')
    @include('partials.breadcrumb')
    <!-- pending orders area start -->
    <section class="pending-order-area section-bg-2">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="pending-order-tab-menu">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            @foreach($mining as $k => $item)
                            <li class="nav-item">
                                <a class="nav-link  @if($k == 0) active @endif " id="orders-tab" data-toggle="tab" href="#active_tab{{$item->id}}" role="tab" aria-controls="orders" aria-selected="true">
                                    {{$item->name}}
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="pending-order-tab-content">
                        <div class="tab-content" id="myTabContent">
                            @foreach($mining as $k => $item)
                            <div class="tab-pane fade  @if($k==0)show active @endif " id="active_tab{{$item->id}}"  role="tabpanel" aria-labelledby="orders-tab">
                                <div class="pricing-area pricing-area-2">
                                    <div class="container">
                                        <div class="row">
                                            @foreach($plans->where('cat_id', $item->id) as $plan)
                                            <div class="col-lg-4 col-md-6">
                                                <div class="single-pricing-table rmb-40"><!-- single pricing table -->
                                                    <div class="price-header">
                                                        <h4 class="name">{!! $plan->title !!}</h4>
                                                    </div>
                                                    <div class="cost-details"><!-- cost details -->
                                                        <div class="slider-result">
                                                            <span class="price">Rate : {!! $plan->rate !!} {!! $basic->currency !!}</span>
                                                            <span class="name">For <strong>{{$plan->period}}  {{$plan->duration}}s</strong></span>
                                                        </div>
                                                    </div>
                                                    <div class="price-body"><!-- price body -->
                                                        <ul>
                                                            <li>Unit : <strong>{!! $plan->unit->name !!}</strong></li>
                                                            <li>{!! $plan->details !!}</li>
                                                        </ul>

                                                        @if(Auth::user())
                                                            <a class="boxed-btn btn-rounded "
                                                               data-toggle="modal" data-target="#Modal{{$plan->id}}">
                                                                Purchase now </a>
                                                            <div class="modal fade" id="Modal{{$plan->id}}" tabindex="-1" role="dialog">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <form role="form" action="{{route('UserPurchasePlan')}}" method="post">
                                                                            {{ csrf_field() }}
                                                                            <div class="modal-header">
                                                                                <h4 class="modal-title" id="myModalLabel"> <i class="fa fa-shopping-cart"></i> Purchase Now </h4>

                                                                                <button type="button" class="close" data-dismiss="modal"
                                                                                        aria-hidden="true"><span class="black">X</span>
                                                                                </button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <p class="error">  Purchase Limit {{$plan->minimum}}- {{$plan->maximum}} {{$plan->unit->name}}</p>

                                                                                <input type="hidden" name="id" value="{{$plan->id}}">
                                                                                <input type="hidden" name="mining_id"
                                                                                       value="{!! $plan->mining->id !!}">
                                                                                <input type="hidden" name="user_id"
                                                                                       value="{{Auth::user()->id}}">
                                                                                <input type="hidden" name="rate" value="{!! $plan->rate !!}">

                                                                                <div class="input-group">
                                                                                    <input type="text" name="totalPlan" class="form-control input-lg" placeholder=" Enter  Purchase Quantity"
                                                                                           required >
                                                                                    <div class="input-group-prepend">
                                                                                        <span class="input-group-text" id="basic-addon1">{{$plan->unit->name}}</span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="submit" class="btn  btn-success "> Yes </button>
                                                                                <button type="button" class="btn btn-default" data-dismiss="modal"> close </button>
                                                                            </div>
                                                                        </form>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @else
                                                            <a href="{{route('login')}}" class="boxed-btn  btn-rounded " >Purchase now</a>
                                                        @endif

                                                    </div><!-- price body -->
                                                </div><!-- //.single pricing table -->
                                            </div>
                                                @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>



        </div>
    </section>
    <!-- pending orders area end -->




@stop