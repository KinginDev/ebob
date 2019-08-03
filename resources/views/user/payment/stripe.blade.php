@extends('user')
@section('content')

    <style>
        .credit-card-box .form-control.error {
            border-color: red;
            outline: 0;
            box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(255, 0, 0, 0.6);
        }

        .credit-card-box label.error {
            font-weight: bold;
            color: red;
            padding: 2px 8px;
            margin-top: 2px;
        }
    </style>
    <div class="get-in-touch-area cotnact-page">
        <div class="container">
            <div class="row">

                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-primary panel-custom">
                        <div class="panel-heading text-center">
                            <h4 class="name">Stripe Payment </h4>
                        </div>

                          
                        <div class="panel-body ">
                            <div class="card-wrapper"></div>
                            <br><br>

                            <form role="form" id="payment-form" method="POST" action="{{ route('save.card')}}">
                                {{csrf_field()}}
                                <input type="hidden" value="{{ $track }}" name="track">
                                <div class="row">
                                    <div class="col-md-6" style="margin: 10px 0px;">
                                       
                                        <label for="name">CARD NAME</label>
                                        <div class="input-group">
                                            <input
                                                    type="text"
                                                    class="form-control input-lg custom-input"
                                                    name="name"
                                                    placeholder="Card Name"
                                                    autocomplete="off" autofocus
                                            />

                                            <span class="input-group-addon"><i class="fa fa-font"></i></span>
                                        </div>

                                    </div>
                                    <div class="col-md-6" style="margin: 10px 0px;">
                                        <label for="cardNumber">CARD NUMBER</label>
                                        <div class="input-group">
                                            <input
                                                    type="tel"
                                                    class="form-control input-lg custom-input"
                                                    name="cardNumber"
                                                    placeholder="Valid Card Number"
                                                    autocomplete="off"
                                                    required autofocus
                                            />
                                            <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
                                        </div>
                                    </div>
                               
                               
                               
                                    <div class="col-md-6" style="margin: 10px 0px;">
                                        <label for="cardExpiry">EXPIRATION DATE</label>
                                        <input
                                                type="tel"
                                                class="form-control input-lg input-sz custom-input"
                                                name="cardExpiry"
                                                placeholder="MM / YYYY"
                                                autocomplete="off"
                                                required
                                        />
                                    </div>
                                    <div class="col-md-6 " style="margin: 10px 0px;">

                                        <label for="cardCVC">CVC CODE</label>
                                        <input
                                                type="tel"
                                                class="form-control input-lg input-sz custom-input"
                                                name="cardCVC"
                                                placeholder="CVC"
                                                autocomplete="off"
                                                required
                                        />

                                    </div>
                               
                                <hr>
                               
                                 
                                    <div class="col-md-12" style="margin: 10px 0px;">
                                        <label for="address">STREET</label>
                                        <input
                                                type="text"
                                                class="form-control input-lg input-sz custom-input"
                                                name="street"
                                                autocomplete=""
                                                placeholder="Street address"
                                                required
                                        />
                                    </div>
                               
                                
                                    <div class="col-md-4 " style="margin: 10px 0px;">

                                        <label for="city">CITY</label>
                                        <input
                                                type="text"
                                                class="form-control input-lg input-sz custom-input"
                                                name="city"
                                                placeholder="City"
                                                required
                                        />

                                    </div>
                                    <div class="col-md-2 " style="margin: 10px 0px;">

                                        <label for="state">STATE</label>
                                        <input
                                                type="text"
                                                class="form-control input-lg input-sz custom-input"
                                                name="state"
                                                placeholder="State"
                                                required
                                        />

                                    </div>
                                    <div class="col-md-2 " style="margin: 10px 0px;">

                                        <label for="state">ZIP CODE</label>
                                        <input
                                                type="text"
                                                class="form-control input-lg input-sz custom-input"
                                                name="zip"
                                                placeholder="Zipcode"
                                                required
                                        />

                                    </div>
                                    <div class="col-md-2 " style="margin: 10px 0px;">

                                        <label for="country">COUNTRY</label>
                                        <input
                                                type="text"
                                                class="form-control input-lg input-sz custom-input"
                                                name="country"
                                                placeholder="Country"
                                                required
                                        />

                                    </div>
                                </div>
                                <br>
                                <button class="btn btn-primary custom-sbtn btn-lg btn-block" type="submit"> PAY NOW
                                </button>

                            </form>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>

@stop

@section('script')
    <script type="text/javascript" src="https://rawgit.com/jessepollak/card/master/dist/card.js"></script>

    <script>
        (function ($) {
            $(document).ready(function () {
                var card = new Card({
                    form: '#payment-form',
                    container: '.card-wrapper',
                    formSelectors: {
                        numberInput: 'input[name="cardNumber"]',
                        expiryInput: 'input[name="cardExpiry"]',
                        cvcInput: 'input[name="cardCVC"]',
                        nameInput: 'input[name="name"]'
                    }
                });
            });
        })(jQuery);
    </script>
@stop


