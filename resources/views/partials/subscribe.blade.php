<!-- subscription area start -->
<section class="subscription-area section-bg-1 padding-top-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 remove-col-padding">
                <div class="subscription-inner">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="left-content-area"><!-- left content area -->
                                <span class="bg-icon"><i class="far fa-envelope"></i></span>
                                <span class="subtitle">Enter Your Email To Get Update News</span>
                                <h4 class="title">Subscribe Now</h4>
                            </div><!-- //.left content area -->
                        </div>
                        <div class="col-lg-6">
                            <div class="right-content-area"><!-- right content area -->
                                <div class="subsform-wrapper">
                                    <form action="{{route('subscribe')}}" method="post">
                                        @csrf
                                        <div class="form-element">
                                            <input type="email" name="email" class="input-field"
                                                   placeholder="Enter your email address......">
                                        </div>
                                        <input type="submit" class="submit-btn" value="get started">
                                    </form>
                                </div>
                            </div><!-- //.right content area-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- subscription area end -->