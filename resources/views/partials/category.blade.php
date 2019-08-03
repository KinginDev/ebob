
@if(count($categories) >0)
    <div class="widget-area category"><!-- category widget start-->
        <div class="widget-title">
            <h4 class="title">Categories</h4>
        </div>
        <div class="widget-body"><!-- widget body -->
            <ul class=""><!-- categories -->
                @foreach($categories as $category)
                    @php
                        $slug = str_slug($category->name)
                    @endphp
                    <li><a href="{{url('cats/'.$category->id.'/'.$slug)}}">{!! $category->name !!} <span
                                    class="count">({!! $category->posts()->count() !!}
                                )</span></a></li>
                @endforeach
            </ul> <!-- ./ cateogries -->
        </div><!-- /. widget body -->
    </div><!-- category widget end-->
@endif