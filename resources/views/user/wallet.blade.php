@extends('user')

@section('content')
    @include('partials.breadcrumb')

    <section class="contact-page-content contact-page-content-pad-t-10 section-bg-2">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12 ">
                    <div class="contact-form-wrapper">
                        {!! Form::open(['method'=>'post','role'=>'form','class'=>'form-horizontal','name' =>'editForm', 'files'=>true]) !!}

                        @foreach($wallets->chunk(2) as $items)
                            <div class="row">
                                @foreach($items as $wallet)
                                    <div class="col-lg-6">
                                        <div class="form-element margin-bottom-30">
                                            <label> {{$wallet->mining->coin_code}}
                                                Wallet</label>
                                            <input type="hidden" name="id[]" value="{{$wallet->id}}">
                                            <input type="text" name="wallet_acc[]" value="{{$wallet->wallet_acc}}"
                                                   class="input-field"
                                                   placeholder="Enter Your {{$wallet->mining->name}}  Account">
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        @endforeach

                        @if(count($wallets) >0)
                            <div class="row">
                                <div class="col-lg-12">
                                    <input type="submit" class=" submit-btn btn " value="Update Wallet">
                                </div>
                            </div>
                        @else

                            <div class="row">
                                <div class="col-lg-12">
                                    <h3 class="text-danger text-center">You have no wallet yet !</h3>
                                </div>
                            </div>
                        @endif

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection
@section('script')

@endsection
