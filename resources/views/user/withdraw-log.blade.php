@extends('user')
@section('content')
    <!-- get in touch area start -->
    <div class="get-in-touch-area cotnact-page">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 remove-col-padding">

                    <div class="panel panel-primary panel-custom "><!-- single pricing table -->
                        <div class="panel-heading ">
                            <h4 class="name">{{$page_title}} </h4>
                        </div>
                        <div class="panel-body">

                            <div class="contact-form-wrapper">
                                <table class="table table-default table-responsive">
                                    <thead>
                                    <tr>
                                        <th scope="col">SL</th>
                                        <th scope="col">Trx</th>
                                        <th scope="col">Method</th>
                                        <th scope="col">Amount</th>
                                        <th scope="col">Charge</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Time</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @if(count($invests) >0)
                                        @foreach($invests as $k=>$data)
                                            <tr>
                                                <td data-label="SL">{{++$k}}</td>
                                                <td data-label="#Trx">{{$data->transaction_id or ''}}</td>
                                                <td data-label="Method">{{$data->method->name or ''}}</td>
                                                <td data-label="Amount">{!!  number_format($data->amount, $basic->decimal)  !!} </td>
                                                <td data-label="Charge">{!! number_format($data->charge, $basic->decimal) !!} </td>
                                                <td data-label="Status">
                                                    @if($data->status == 1)
                                                        <button class="btn btn-primary btn-sm">
                                                            Pending
                                                        </button>
                                                    @elseif($data->status == 2)
                                                        <button class="btn btn-success btn-sm">
                                                            Approved
                                                        </button>
                                                    @elseif($data->status == -2)
                                                        <button class="btn btn-warning btn-sm">
                                                            Refunded
                                                        </button>
                                                    @endif
                                                </td>
                                                <td data-label="Time">
                                                    {!! date(' d M, Y h:s A', strtotime($data->created_at)) !!}</td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="7"> You don't have any withdraw history !!</td>
                                        </tr>
                                    @endif
                                    </tbody>
                                </table>

                            </div>
                            <div class="post-navigation">
                                <ul class="pagination">
                                    {{ $invests->links('partials.pagination') }}
                                </ul>
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