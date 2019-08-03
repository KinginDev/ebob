@extends('admin.layout.master')

@section('body')
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <h3 class="tile-title ">{{$page_title}}</h3>
                <div class="tile-body">
                    <form role="form" method="POST" action="">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-4">
                                <h6>Website Title</h6>
                                <div class="input-group">
                                    <input type="text" class="form-control input-lg" value="{{$general->sitename}}"
                                           name="sitename">
                                    <div class="input-group-append"><span class="input-group-text">
                                            <i class="fa fa-file-text-o"></i>
                                            </span>
                                    </div>
                                </div>
                                <span class="text-danger">{{$errors->first('sitename')}}</span>
                            </div>

                            <div class="col-md-4">
                                <h6>COLOR</h6>
                                <div class="input-group">
                                    <input type="text" class="form-control input-lg" style="background-color: #{!! $general->color !!} " value="#{!! $general->color !!}"
                                           name="color">
                                    <div class="input-group-append"><span class="input-group-text">
                                            <i class="fa fa-paint-brush"></i>
                                        </span>
                                    </div>
                                </div>
                                <span class="text-danger">{{ $errors->first('color') }}</span>
                            </div>


                            <div class="col-md-4">
                                <h6>Decimal After Point</h6>
                                <div class="input-group">
                                    <input type="text" class="form-control input-lg" value="{{$general->decimal}}"
                                           name="decimal">
                                    <div class="input-group-append"><span class="input-group-text">
                                            Decimal
                                            </span>
                                    </div>
                                </div>
                                <span class="text-danger">{{ $errors->first('decimal') }}</span>
                            </div>




                        </div>
                        <br>
                        <div class="row">


                            <div class="col-md-4">
                                <h6>BASE CURRENCY </h6>
                                <div class="input-group">
                                    <input type="text" class="form-control input-lg" value="{{$general->currency}}" name="currency">
                                    <div class="input-group-append"><span class="input-group-text">
                                            <i class="fa fa-money"></i>
                                            </span>
                                    </div>
                                </div>
                                <span class="text-danger">{{ $errors->first('currency') }}</span>
                            </div>
                            <div class="col-md-4">
                                <h6>CURRENCY SYMBOL</h6>
                                <div class="input-group">
                                    <input type="text" class="form-control input-lg" value="{{$general->currency_sym}}"
                                           name="currency_sym">
                                    <div class="input-group-append"><span class="input-group-text">
                                            <i class="fa fa-exclamation-circle"></i>
                                            </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <h6>BTC WALLET</h6>
                                <div class="input-group">
                                    <input type="text" class="form-control input-lg" value="{{$general->adminWallet}}"
                                           name="adminWallet">
                                    <div class="input-group-append"><span class="input-group-text">
                                            <i class="fas fa-wallet"></i>
                                            </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                    <h6>ETH WALLET</h6>
                                    <div class="input-group">
                                        <input type="text" class="form-control input-lg" value="{{$general->ethWalletAddress}}"
                                               name="ethWalletAddress">
                                        <div class="input-group-append"><span class="input-group-text">
                                                <i class="fas fa-wallet"></i>
                                                </span>
                                        </div>
                                    </div>
                                </div>

                            <div class="col-md-4">
                                <h6>REGISTRATION</h6>
                                <input data-toggle="toggle" data-onstyle="success" data-offstyle="danger"
                                       data-width="100%" type="checkbox"
                                       name="registration" {{$general->registration == "1" ? 'checked' : '' }}>
                            </div>



                        </div>
                        <br>

                        <div class="row">

                            <div class="col-md-3">
                                <h6>EMAIL VERIFICATION</h6>
                                <input data-toggle="toggle" data-onstyle="success" data-offstyle="danger"
                                       data-width="100%" type="checkbox"
                                       name="email_verification" {{ $general->email_verification == "1" ? 'checked' : '' }}>
                            </div>

                            <div class="col-md-3">
                                <h6>EMAIL NOTIFICATION</h6>
                                <input data-toggle="toggle" data-onstyle="success" data-offstyle="danger"
                                       data-width="100%" type="checkbox"
                                       name="email_notification" {{ $general->email_notification == "1" ? 'checked' : '' }}>
                            </div>

                            <div class="col-md-3">
                                <h6>SMS VERIFICATION</h6>
                                <input data-toggle="toggle" data-onstyle="success" data-offstyle="danger"
                                       data-width="100%" type="checkbox"
                                       name="sms_verification" {{$general->sms_verification == "1" ? 'checked' : ''}}>
                            </div>

                            <div class="col-md-3">
                                <h6>SMS NOTIFICATION</h6>
                                <input data-toggle="toggle" data-onstyle="success" data-offstyle="danger"
                                       data-width="100%" type="checkbox"
                                       name="sms_notification" {{ $general->sms_notification == "1" ? 'checked' : '' }}>
                            </div>
                            <div class="col-md-3">
                                <h6>CAPTCHA</h6>
                                <input data-toggle="toggle" data-onstyle="success" data-offstyle="danger"
                                       data-width="100%" type="checkbox"
                                       name="captcha" {{ $general->captcha == "1" ? 'checked' : '' }}>
                            </div>

                        </div>
                             <div class="row">

                            

                           
                        </div>
                        <br>
                        <br>
                        <div class="row">
                            <hr/>
                            <div class="col-md-12 ">
                                <button class="btn btn-primary btn-block btn-lg">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')

@stop