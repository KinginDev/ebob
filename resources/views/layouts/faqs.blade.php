@extends('layout')
@section('content')

    <!-- faq area start -->
    <section class="faq-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="single-faq-area"><!-- single faq area -->
                        <div class="accordion-wrapper">
                            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                @foreach($faqs as $k => $f)
                                    <div class="panel panel-default">
                                        <div class="panel-heading" role="tab" id="heading{{$f->id}}">
                                            <h4 class="panel-title">
                                                <a role="button" data-toggle="collapse" data-parent="#accordion"
                                                   href="#collapse{{$k}}" aria-expanded="true" aria-controls="collapseOne">
                                                    <span class="icon"><i class="pe-7s-male"></i></span> {{$f->title}}
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapse{{$k}}" class="panel-collapse collapse @if($k==0)in @endif " role="tabpanel"
                                             aria-labelledby="heading{{$f->id}}">
                                            <div class="panel-body">
                                               <div class="nicEdit-main">{!! $f->description !!}</div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    </div><!-- //.single faq area -->
                </div>
            </div>
        </div>
    </section>
    <!-- faq area end -->



@stop