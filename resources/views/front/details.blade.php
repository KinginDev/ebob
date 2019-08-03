@extends('layout')
@section('css')
    <link rel="stylesheet" href="{{asset('assets/front/css/details.css')}}">
@stop
@section('content')
    <style>
        .breadcrumb-area.breadcrumb-bg {
            background-image: url(../../assets/images/post/{{$post->image}});
            background-size: cover;
            background-position: center;
        }
    </style>
    @include('partials.breadcrumb')
    <!-- blog details page content area start -->
    <section class="blog-details-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="single-blog-post"><!-- single blog post -->
                        <div class="meta-time"><!-- meta time -->
                            <span class="date">{{date('d',strtotime($post->created_at))}}</span>
                            <span class="month">{{date('M ',strtotime($post->created_at))}}</span>
                        </div><!-- //.meta time -->
                        <div class="details-container"><!-- details contaienr -->

                            <div class="post-body"><!-- post body -->
                                <h3 class="title"> {!! $post->title !!}</h3>
                                <p> {!! $post->details !!}</p>
                                <div class="post-bottom-content"><!-- post bottom content -->
                                    <div class="top-content"><!-- top content -->
                                        <div class="left-content"><h4 class="title">Social Share </h4></div>
                                    </div><!-- //.top content -->
                                    <div class="bottom-content"><!-- bottom content -->
                                        <div class="left-content"><!-- left content -->
                                            <ul>
                                                <li><a href="https://www.facebook.com/sharer/sharer.php?u={{urlencode(url()->current()) }}"><i class="fab fa-facebook-f"></i></a></li>
                                                <li><a href="https://twitter.com/intent/tweet?text=my share text&amp;url={{urlencode(url()->current()) }}"><i class="fab fa-twitter"></i></a></li>
                                                <li><a href="https://plus.google.com/share?url={{urlencode(url()->current()) }}"><i class="fab fa-google-plus-g"></i></a></li>
                                                <li><a href="https://www.linkedin.com/shareArticle?mini=true&amp;url={{urlencode(url()->current()) }}&amp;title=my share text&amp;summary=dit is de linkedin summary"><i class="fab fa-linkedin-in"></i></a></li>
                                            </ul>
                                        </div>
                                    </div><!-- //.bottom content -->
                                </div>
                            </div>
                        </div>





                        {!!  show_add(2)!!}
                        <span class="line-separator"></span>
                        <div class="fb-comments" data-colorscheme="dark" data-width="100%"
                             data-href="{{url()->current()}}"
                             data-numposts="5"></div>
                    </div>
                </div><!-- //.col-lg-8 -->
                <div class="col-lg-4">
                    <aside class="sidebar">
                        <div class="widget-area">
                            <div class="widget-body">
                                {!!  show_add(1)!!}
                            </div>
                        </div>
                        <!-- instragram widget end -->
                        <div class="sidebar-separator"></div>
                        @if(count($categories) >0)
                            <div class="widget-area category">
                                <!-- category widget start-->
                                <div class="widget-title">
                                    <h4>Categories</h4>
                                </div>
                                <div class="widget-body">
                                    <!-- widget body -->
                                    <ul class="categories">
                                        @foreach($categories as $category)
                                            @php
                                                $slug = str_slug($category->name)
                                            @endphp
                                            <li>
                                                <a href="{{route('cats.blog',[$category->id,$slug])}}">{!! $category->name !!}
                                                    <span class="count">({!! $category->posts()->count() !!})</span>
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                    <!-- ./ cateogries -->
                                </div>
                                <!-- /. widget body -->
                            </div>
                            <!-- category widget end-->
                            <div class="sidebar-separator category"></div>
                        @endif
                        <div class="widget-area latest-post">
                            <!-- latest post widget start -->
                            <div class="widget-title">
                                <h4>Latest Posts</h4>
                            </div>
                            <div class="widget-body">
                                <!-- widget body -->
                                @foreach($latest as $data)
                                    @php
                                        $slug  = str_slug($post->title);
                                    @endphp
                                    <div class="single-latest-post">
                                        <!-- single lates post item start-->
                                        <div class="media">
                                            <div class="media-left">
                                                <img src="{{asset('assets/images/post/'.$data->image)}}"
                                                     class="media-object max-width-80 mt-15" style="margin-top: 15px">
                                            </div>
                                            <div class="media-body">
                                                <a href="{{route('blog.details',[$data->id,$slug])}}">
                                                    <h5 class="mt-0">{{$data->title}}</h5>
                                                </a>
                                                <span class="meta-time">
                                                <i class="far fa-clock"></i> {{Carbon\Carbon::parse($data->created_at)->diffForHumans()}}</span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <!-- /. widget body -->
                        </div>
                        <div class="sidebar-separator latest-post"></div>
                        <!-- latest post widget end -->

                        <div class="widget-area">
                            {!!  show_add(3)!!}
                        </div>

                        <!-- tag widget  end -->
                    </aside>
                    <!-- sidebar end -->
                </div><!-- //.col-lg-4 -->
            </div><!-- //.row -->
        </div><!-- //.container -->
    </section>
    <!-- blog details page content area end -->

@stop