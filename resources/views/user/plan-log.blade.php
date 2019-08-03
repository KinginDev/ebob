@extends('user')
@section('content')
    @include('partials.breadcrumb')
    <!-- pending orders area start -->
    <section class="pending-order-area section-bg-2">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="pending-order-tab-content">
                        <table class="table table-default table-responsive">
                            <thead>
                            <tr>
                                <th scope="col">SL</th>
                                <th scope="col">Purchase Date</th>
                                <th scope="col">Miner Name</th>
                                <th scope="col">Total Price</th>
                                <th scope="col">Speed</th>
                                <th scope="col">Coin Name</th>
                                <th scope="col">Status</th>
                                <th scope="col">Expired Date</th>
                            </tr>
                            </thead>
                            <tbody>

                            @if(count($myPlan) >0)

                                @foreach($myPlan as $k=>$data)
                                    <tr>
                                        <td data-label="SL">{{++$k}}</td>
                                        <td data-label="Purchase Date">{{   date(' d F, Y h:s A', strtotime($data->created_at))}}</td>
                                        <td data-label="Title">{!! $data->pricingPlan->title  or '' !!}</td>
                                        <td data-label="Price">{{number_format(($data->pricingPlan->rate * $data->qty), $basic->decimal)}} {{$basic->currency}}</td>
                                        <td data-label="Speed">{{$data->qty .' '. $data->pricingPlan->unit->name}}</td>
                                        <td data-label="Miner">{{$data->pricingPlan->mining->name}}</td>
                                        <td data-label="Status">
                                            @if($data->status == 1)
                                                <button class="btn btn-success btn-sm">
                                                    Active
                                                </button>
                                            @elseif($data->status == -1)
                                                <button class="btn btn-warning btn-sm">
                                                    Expired
                                                </button>
                                            @endif
                                        </td>
                                        <td data-label="Time">{!! date(' d F, Y h:s A', strtotime($data->end_time)) !!} </td>
                                    </tr>
                                    <tr>
                                        <td colspan="9" class="td-separator">
                                            <span class="separator"></span>
                                        </td>
                                    </tr>
                                @endforeach

                            @else
                                <tr>
                                    <td colspan="9"> You don't have any plan purchase  history !!</td>
                                </tr>

                                <tr>
                                    <td colspan="9" class="td-separator">
                                        <span class="separator"></span>
                                    </td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                        <div class="post-navigation">
                            <ul class="pagination">
                                {{ $myPlan->links('partials.pagination') }}
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- pending orders area end -->


@stop