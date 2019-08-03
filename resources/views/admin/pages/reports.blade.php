@extends('admin.layout.master')

@section('body')
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-title ">
                </div>
                <div class="tile-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" >
                            <thead>
                            <tr>
                                <th>SL</th>
                                <th> Report From </th>
                                <th>Milestone Title</th>
                                <th>Message</th>
                                <th>ACTION</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($reports as $k=>$dep)
                                @php
                                    $data = App\Report::where('milestone_id',$dep->milestone_id)->latest()->where('report_from','!=',0)->first();
                                @endphp

                                    <tr>
                                        <td>{{++$k}}</td>
                                        <td>
                                            @if($data->report_from != 0)
                                            <a href="{{route('user.single', $data->user->id)}}">
                                                {{$data->user->username or ''}}
                                            </a>
                                                @else
                                                <a >
                                                    Admin
                                                </a>
                                            @endif
                                        </td>
                                        <td>
                                                {{  $data->reports->title}}
                                        </td>

                                        <td>
                                            @if($data->is_read == 0)
                                                <b>{{  $data->report}}</b>
                                            @else
                                                {{  $data->report}}
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{route('reports.view',$data->milestone_id)}}" class="btn btn-outline-primary btn-sm" >
                                                <i class="fa fa-eye"></i> view </a>
                                        </td>
                                    </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{$reports->links()}}
                </div>

            </div>
        </div>
    </div>



@endsection

@section('script')
@stop

