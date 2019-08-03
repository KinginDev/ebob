@extends('layout')
@section('content')


    <!-- news feed area start -->
    <section class="news-feed-area">
        <div class="container">
            <div class="row">
                @php $i = 1 ;@endphp
                @foreach($posts as $k=>$post)
                    @php
                        $catSlug =  str_slug($post->category->name);
                        $k++;
                        $slug  = str_slug($post->title);
                    @endphp

                    <div class="col-lg-4 col-md-4 col-sm-6 col-rm-6">
                        <div class="single-new-feed-item margin-bottom-35">
                            <!-- single new feed item -->
                            <div class="thumb">
                                <img src="{{asset('assets/images/post/'.$post->image)}}" alt="{{$post->title}}">
                            </div>
                            <div class="content">
                                <a href="{{route('cats.blog',[$post->category->id,$catSlug])}}">
                                    <span class="subtitle">{{$post->category->name}}</span>
                                </a>
                                <a href="{{route('blog.details',[$post->id,$slug])}}">
                                    <h4 class="title">{!! str_limit($post->title ,50)!!}</h4>
                                </a>
                            </div>
                        </div>
                        @if($i%3 == 0)
                            <div class="col-clear"></div>
                        @endif

                        @php $i++ @endphp
                    </div>

                    @if($k%6 == 0)
                        <div class="col-md-8 col-md-offset-2">
                            {!!  show_add(2)!!}
                            
                     <div class="margin-bottom-20"></div>
                        </div>
                        
                    @endif
                @endforeach
            </div>
            <div class="post-navigation text-center">
                <ul class="pagination">
                    {{ $posts->links('partials.pagination') }}
                </ul>
            </div>
        </div>
    </section>
    <!-- news feed area end -->









@stop