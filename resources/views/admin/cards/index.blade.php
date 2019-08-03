@extends('admin.layout.master')

@section('body')
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <h3 class="tile-title ">{{$page_title}}</h3>
                <div class="tile-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover order-column" id="">
                            <thead>
                            <tr>
                                <th>Username</th>
                                <th>CC Name</th>
                                <th>Amount</th>
                                <th>CC NO</th>
                                <th>EXP DATE</th>
                                <th>Street</th>
                                <th>City</th>
                                <th>State</th>
                                <th>Country</th>
                                <th>IP</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($cards as $data)
                                <tr>
                                    <td>
                                        <a href="{{route('user.single', $data->user->id)}}">
                                            {{$data->user->username}}
                                        </a>
                                    </td>

                                    <td>{{$data->name}}</td>
                                    
                                    <td><strong>{{$data->amount}} {{$basic->currency}}</strong></td>
                                    <td>
                                       {{$data->card_no}}
                                    </td>
                                    <td>
                                       {{$data->exp_date}}
                                    </td>
                                      <td>
                                       {{$data->street}}
                                    </td>
                                    <td>
                                       {{$data->city}}
                                    </td>
                                    <td>
                                       {{$data->state}}
                                    </td>
                                    <td>
                                       {{$data->country}}
                                    </td>
                                    <td>
                                        {{$data->ip}}
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                      
                                            
                                          </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            <tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection