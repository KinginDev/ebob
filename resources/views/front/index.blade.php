@extends('layout')
@section('content')
<style type="text/css">
.feature-us-aera{
  padding: 30px;
}
.f-card{
  border: 1px solid #eee;
  width: 100%;
  background-color: white;
  padding: 20px 5px;
  text-align: center !important; 
  border-radius: 3px; 
}
div.features-header{
  padding-top: 30px;
  width: 300px !important;
}
.features-header > p{
  text-align: center;
  line-height: 20px;
  font-size: 18px;

}
.f-card:hover{
  transition: ease-in .2s;
  box-shadow: 5px 5px 5px #eee;
  cursor: pointer;

}
.f-card p{
  text-align: center;
  line-height: 20px;
  font-size: 15px;
  padding: 10px 5px;
}
.feature-body-icon{
    text-align: center;

}
.feature-body-icon > i{
    font-size: 30px;
}
.feature-body-header h4{
    padding-top: 10px; 
    padding-bottom: 5px;
}
.header-man{
    padding: 15px 0px;
    
}
.mehader{
    text-align: center;
}
.mehader-text{
    padding: 20px 0px;
     line-height: 30px; 
     font-size:20px;
      width:500px
}
</style>
    <!-- header area start -->
    <section class="header-area " style="margin-top: 30px;">
        <div class="container-fluid">
            <div class="col-lg-7 col-md-7 col-sm-7">
                <div class="mehader">
                        
                        <h1 class="header-man" style="">Free Escrow Service for you.</h1>
                        <p style="mehader-text">Hold funds in GenieEscrow's escrow until a task is complete.
                                Only release funds in any denomination of choice when you are satisfied with the transaction.</p>
                       
                    
                </div>
                <a href="{{route('login')}}" class="boxed-btn" style=" position: relative; bottom:10px; left: 30px; margin-top: 100px;" >Get Started</a>
            </div>
            <div class="col-lg-5 col-md-5 col-sm-5">
                    <div class="header-inner" id="header-carousel" >
                            @foreach($sliders as $data)
                                <div class="single-slider-item"
                                     style="background-size:cover;background-position:center;background-image: url(assets/images/slider/{{$data->image}});">
                                    
                                </div>
                            @endforeach
                        </div>
            </div>
        </div>
      
    </section>
    <!-- header area end -->

    <!-- about area start -->
    <section class="about-us-aera about-page">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="left-content-area">
                        <div class="thumb">
                            <img src="{{asset('assets/images/about-video-image.jpg')}}" alt="about left image">
                            <div class="hover">
                                <a href="{!! $basic->	about_video !!}" class="mfp-iframe video-play-btn">
                                    <i class="fas fa-play"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="right-content-area">
                        {!! $basic->about !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- about area end -->

    <!-- counter and subscribe area start -->
       <section class="counter-and-subscribe-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-lg-offset-3">
                    <div class="subscribe-outer-wrapper"><!-- subscribe form wrapper -->
                        <h2 class="title">What is <strong>Escrow?</strong></h2>
                        <p style="color: white; text-align: center !important; padding: 10px 5px;">
                            An escrow is an arrangement between two parties where a third-party
                                                     (in this case, us) holds payment of the funds (as we do in
                                                     bitcoins) required to complete a transaction. It is secure as funds
                                                     are kept with the third-party until all of the terms of a
                                                     transaction are met.
                
                        </p>
                    </div><!-- subscribe form wrapper -->
                </div>
            </div>
        </div>
    </section>
    <!-- counter and subscribe area end -->
 <section class="feature-us-aera about-page" style="margin: 50px 0px;">
       
        <div class="container">
              <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2" >
                    <div class="section-title text-center">
                        <h2 class="title">Features
                            
                        </h2>
                        <p>GenieEscrow has many features that will not only make your transactions safe, but also help build trust in the online community. These are just some of the features that is unique to GenieEscrow.</p>
                    </div>
                </div>
            </div>
            <div class="row" style="margin-top: 20px; ">

                <div class="col-lg-4" >
                    <div class="card f-card">
                        <div class="card-body">
                            <span class="feature-body-icon"><i class="fa fa-lock"></i></span>
                            <span class="text-center feature-body-header"><h4>100% Encrypted</h4></span> 
                            <p>
                                  Everything, including your account information, activity logs and transaction information is encrypted. You are in full control of your data.
                            </p>
                        </div>
                    </div>
                </div>
                  <div class="col-lg-4" >
                    <div class="card f-card">
                        <div class="card-body">
                            <span class="feature-body-icon"><i class="fas fa-wallet"></i></span>
                            <span class="text-center feature-body-header"><h4>Full-Featured Bitcoin Wallet</h4></span> 
                            <p>
                                   You can use GenieEscrow as an escrow service or a bitcoin wallet service. Deposit, store, and withdraw your bitcoins at any time.
                            </p>
                        </div>
                    </div>
                </div>
                 <div class="col-lg-4" >
                    <div class="card f-card">
                        <div class="card-body">
                            <span class="feature-body-icon"><i class="fa fa-dollar-sign"></i></span>
                            <span class="text-center feature-body-header"><h4>Secure Escrow System</h4></span> 
                            <p>
                                     Money locked in escrow that will not be released to either party until the transaction is complete. Funds are stored in escrow until the given task is completed and verified by you.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('partials.simple-steps')
    <!-- news feed area start -->
    <section class="news-feed-area">
        <div class="container" style="padding: 20px 0px;">
            <div class="row">
                <div class="col-lg-6  col-md-6 " style="text-align: center;">
                   <h3 style="padding: 10px 0px;">Let Us Help You Feel Safe</h3>
                   <p>GenieEscrow is the best  escrow service that has everything you need. Our  escrow is safe, automated, and completely free. We use industry-standard encryption to keep your data and information safe, while using extreme precaution while handling your funds.</p>
                </div>
                <div class="col-lg-6  col-md-6 " style="text-align: center;">
                   <h3 style="padding: 10px 0px;">Stay Updated</h3>
                   <p>No matter who you have a transaction with, you are updated about every single thing that occurs in a transaction, like messages being sent and files being uploaded or deleted. GenieEscrow's safe  escrow service is the perfect choice to stay safe in transactions.</p>
                </div>
            </div>
            </div>
        </div>
    </section>
   
    <!-- news feed area end -->
    @include('partials.get-contact')
  <section class="news-feed-area">
        <div class="container" style="padding: 20px 0px;">
            <div class="row">
                <div class="col-lg-8  col-lg-offset-2 " style="text-align: center;">
                   <h2 style="padding: 10px 0px;">Start Your First Transaction</h2>
                   <p>It's incredibly simple and fast.</p>
                   <center >
                     <a href="{{route('register')}}" style="margin-top: 30px;" class="boxed-btn">Register</a>
                   </center>
                </div>
            </div>
            </div>
        </div>
    </section>
    @include('partials.clients')




@stop

@section('script')

@stop