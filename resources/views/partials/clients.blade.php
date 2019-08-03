<!-- happy clients area start -->
<section class="happy-clients-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2">
                <div class="section-title text-center">
                    <h2 class="title">Our
                        <strong> clients</strong>
                    </h2>
                   
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="brand-carousel" id="brand-carousel">
                    <!-- brand carousel -->
                    @foreach($clients as $data)
                        <div class="single-brand-logo">
                            <a href="{!! $data->link !!}">
                                <img src="{{asset('assets/images/our-client/'.$data->image)}}" alt="brand logo">
                            </a>
                        </div>
                    @endforeach
                </div>
                <!-- //.brand carousel -->
            </div>
        </div>
    </div>
</section>
<!-- happy clients area end -->
