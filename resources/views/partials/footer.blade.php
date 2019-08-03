<footer class="footer-area">
    <div class="container">
        <div class="row">

            <div class="col-md-8 col-md-offset-2">
                <div class="footer_widget about rmb-40  ">
                    <div class="widget_body">
                        <div class="footer-logo text-center">
                            <img src="{{asset('assets/images/logo/logo.png')}}" alt="logo"  class="footer-panel-img">
                        </div>
                <p class="text-center">{!! $basic->short_about !!}</p>

                        <ul class="social-icons text-center">
                            @foreach($social as $data)
                                <li><a href="{!! $data->link !!}">{!! $data->code !!}</a></li>
                            @endforeach
                        </ul>

                    </div>
                </div>
            </div>


            <div class="col-md-8 col-md-offset-2">
                <div class="footer_widget about rmb-40  margin-top-20">
                    <div class="widget_body">
                        <p class="text-center ">&copy; {{$basic->sitename}} {{date('Y')}}. All Right Reserved.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<div class="back-to-top"> <!-- back to top start -->
    <i class="fas fa-rocket"></i>
</div><!-- back to top end -->

<!-- preloader area start -->
<div class="preloader" id="preloader">
    <div class="preloader-inner">
        <div class="a" style="--n: 5;">
            <div class="dot" style="--i: 0;"></div>
            <div class="dot" style="--i: 1;"></div>
            <div class="dot" style="--i: 2;"></div>
            <div class="dot" style="--i: 3;"></div>
            <div class="dot" style="--i: 4;"></div>
        </div>
    </div>
</div>
<!-- preloader area end -->