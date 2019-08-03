@if(count($popular) >0)
    <div class="widget-area trending"><!-- widget area -->
        <div class="widget-title">
            <h4 class="title">Popular Post</h4>
        </div>
        <div class="widget-body">
            @foreach($popular as $data)
                @php
                    $slug = str_slug($data->title)
                @endphp
                <div class="single-trending-post"><!-- single trending post -->
                    <div class="thumb">
                        <a href="{{route('blog.details',[$data->id,$slug])}}">
                        <img src="{{asset('assets/images/post/'.$data->image)}}" alt="trending images" class="popular-img">
                        </a>
                    </div>
                    <div class="content">
                        <a href="{{route('blog.details',[$data->id,$slug])}}">
                            <h4 class="title">{{str_limit($data->title,30)}}</h4>
                        </a>
                        <ul class="post-meta">
                            <li>{{$data->created_at->format('d F, Y')}} </li>
                        </ul>
                        <div class="decription">
                            <p>{!! str_limit(strip_tags($data->details),65) !!}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>


@endif
