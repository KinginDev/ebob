@extends('user')
@section('content')
    <div class="get-in-touch-area cotnact-page">

        <div class="container">
            @include('partials.flash-msg')
            <div class="row">
                <div class="col-lg-8 col-md-offset-2">


                    <form method="POST" action="{{route('deposit.confirm')}}">
                        {{csrf_field()}}
                        <div class="panel panel-primary panel-custom text-center">
                            <div class="panel-heading">
                                <h4 class="name">{{$page_title}}</h4>
                            </div>
                            <div class="panel-body ">
                                <ul class="list-group">
                                    <li class="list-group-item text-color">
                                        <img src="{{asset('assets/images/gateway')}}/{{$data->gateway_id}}.jpg"
                                             style="max-width:100px; max-height:100px; margin:0 auto;"/>
                                    </li>
                                    <li class="list-group-item text-color"> Amount : {{$data->amount}}
                                        <strong>{{$basic->currency}}</strong>
                                    </li>


                                    <li class="list-group-item text-color"> Charge :
                                        <strong>{{$data->charge}} </strong>{{ $basic->currency }}</li>
                                    <li class="list-group-item text-color"> Payable :
                                        <strong>{{$data->charge + $data->amount}} </strong>{{ $basic->currency }}</li>



@if($data->gateway_id == 107 || $data->gateway_id == 108)

                                    <li class="list-group-item text-color"> In NGN :
                                        <strong>₦ {{$data->usd}}</strong>
                                    </li>
@else
                                    <li class="list-group-item text-color"> In USD :
                                        <strong>${{$data->usd}}</strong>
                                    </li>
    @endif                                
                                    
                                </ul>
                            </div>
                            <div class="panel-footer">
                                <button type="submit" class="btn btn-primary custom-sbtn btn-lg btn-block"  id="btn-confirm">Pay Now
                                </button>
                            </div>

                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
@section('js')
    @if($data->gateway_id == 107)
        <form action="{{ route('ipn.paystack') }}" method="POST">
            @csrf
            <script
                    src="//js.paystack.co/v1/inline.js"
                    data-key="{{ $data->gateway->val1 }}"
                    data-email="{{ $data->user->email }}"
                    data-amount="{{ round($data->usd, 2)*100 }}"
                    data-currency="NGN"
                    data-ref="{{ $data->trx }}"
                    data-custom-button="btn-confirm"
            >
            </script>
        </form>
    @elseif($data->gateway_id == 108)
        <script src="//voguepay.com/js/voguepay.js"></script>
        <script>
            closedFunction = function() {

            }
            successFunction = function(transaction_id) {
                window.location.href = '{{ url('user/vogue') }}/' + transaction_id + '/success';
            }
            failedFunction=function(transaction_id) {
                window.location.href = '{{ url('user/vogue') }}/' + transaction_id + '/error';
            }

            function pay(item, price) {
                //Initiate voguepay inline payment
                Voguepay.init({
                    v_merchant_id: "{{ $data->gateway->val1 }}",
                    total: price,
                    notify_url: "{{ route('ipn.voguepay') }}",
                    cur: 'NGN',
                    merchant_ref: "{{ $data->trx }}",
                    memo:'ADD FUND',
                    recurrent: true,
                    frequency: 10,
                    developer_code: '5af93ca2913fd',
                    store_id:"{{ $data->user_id }}",
                    custom: "{{ $data->trx }}",

                    closed:closedFunction,
                    success:successFunction,
                    failed:failedFunction
                });
            }

            $(document).ready(function () {
                $(document).on('click', '#btn-confirm', function (e) {
                    e.preventDefault();
                    pay('Buy', {{ $data->usd }});
                });
            })
        </script>

    @endif
@endsection