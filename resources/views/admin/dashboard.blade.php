@extends('admin.layout.master')

@section('body')

    <div class="row">

        <div class="col-md-6 col-lg-3">
            <a href="{{route('admin.reports')}}" class="text-decoration">
                <div class="widget-small warning coloured-icon"><i class="icon fa fa-flag-o fa-3x"></i>
                    <div class="info">
                        <h6 class="text-uppercase">New Reports</h6>
                        <p><b>{{$reports}}</b></p>
                    </div>
                </div>
            </a>
        </div>


        <div class="col-md-6 col-lg-3">
            <a href="{{route('admin.blog')}}" class="text-decoration">
                <div class="widget-small primary coloured-icon"><i class="icon fa fa-newspaper fa-3x"></i>
                    <div class="info">
                        <h4>Blog</h4>
                        <p><b>{{$blog}} </b></p>
                    </div>
                </div>
            </a>
        </div>



        <div class="col-md-6 col-lg-3">
            <a href="{{route('gateway')}}" class="text-decoration">
                <div class="widget-small warning coloured-icon"><i class="icon fa fa-credit-card fa-3x"></i>
                    <div class="info">
                        <h4>Gateway</h4>
                        <p><b>{{$gateway}}</b></p>
                    </div>
                </div>
            </a>
        </div>


        <div class="col-md-6 col-lg-3">
            <a href="{{route('withdraw')}}" class="text-decoration">
                <div class="widget-small  danger coloured-icon">
                    <i class="icon fa fa-credit-card-alt fa-3x" aria-hidden="true"></i>
                    <div class="info">
                        <h4>Withdraw</h4>
                        <p><b> {{$withdraw}} </b></p>
                    </div>
                </div>
            </a>
        </div>


        <div class="col-md-6 col-lg-3">
            <a href="{{route('withdraw.requests')}}" class="text-decoration">
                <div class="widget-small info coloured-icon"><i class="icon fa fa-money fa-3x"></i>
                    <div class="info">
                        <h4>Withdraw </h4>
                        <p><b>{{$withdrawReq}} Request</b></p>
                    </div>
                </div>
            </a>
        </div>


        <div class="col-md-6 col-lg-3">
            <a href="{{route('users')}}" class="text-decoration">
                <div class="widget-small primary coloured-icon"><i class="icon fa fa-users fa-3x"></i>
                    <div class="info">
                        <h4>Total</h4>
                        <p><b>{{$totalUsers}} Users</b></p>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-6 col-lg-3">
            <a href="{{route('user.ban')}}" class="text-decoration">
                <div class="widget-small danger coloured-icon"><i class="icon fa fa-users fa-3x"></i>
                    <div class="info">
                        <h4>banned</h4>
                        <p><b>{{$banUsers}} Users</b></p>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-6 col-lg-3">
            <a href="{{route('manage.subscribers')}}" class="text-decoration">
                <div class="widget-small info coloured-icon"><i class="icon fa fa-thumbs-up fa-3x"></i>
                    <div class="info">
                        <h4>Subscribers </h4>
                        <p><b>{{$subscribers}} </b></p>
                    </div>
                </div>
            </a>
        </div>


    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <h3 class="tile-title">User Subscription</h3>
                <div class="embed-responsive embed-responsive-16by9">
                    <canvas class="embed-responsive-item" id="lineChartDemo"></canvas>
                </div>
            </div>
        </div>
    </div>

    @php

    $sell =  \App\Subscriber::whereYear('created_at', '=', date('Y'))->get()->groupBy(function($d) {
          return $d->created_at->format('F');
       });
       $monthly_sell = [];
       $month = [];
       foreach ($sell as $key => $value) {
        $monthly_sell[] = count($value);
        $month[] = $key;
       }
    @endphp




@endsection

@section('script')
    <script type="text/javascript" src="{{asset('assets/admin/js/chart.js')}}"></script>
    <script type="text/javascript">
        var data = {
            labels:  {!! json_encode($month) !!},
            datasets: [
                {
                    label: "My Second dataset",
                    fillColor: "rgba(151,187,205,0.2)",
                    strokeColor: "rgba(151,187,205,1)",
                    pointColor: "rgba(151,187,205,1)",
                    pointStrokeColor: "#fff",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(151,187,205,1)",
                    data: {!! json_encode($monthly_sell) !!},
                }
            ]
        };


        var ctxl = $("#lineChartDemo").get(0).getContext("2d");
        var lineChart = new Chart(ctxl).Line(data);

    </script>

@stop

