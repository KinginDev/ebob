@if(count($social) >0)
    <div class="widget-area social"><!-- social widget start-->
        <div class="widget-title">
            <h4>Follow Us</h4>
        </div>
        <div class="widget-body"> <!-- widget body-->
            <ul class="social-links"><!-- social links-->
                @foreach($social as $data)
                    <li>
                        <a href="{{$data->link}}" class="wordpress">
                            {!! $data->code !!}
                        </a>
                    </li>
                @endforeach

            </ul> <!-- ./ social links-->
        </div><!-- ./ widget body -->
    </div>
@endif
