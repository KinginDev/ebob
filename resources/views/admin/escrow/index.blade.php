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
                                <th>Creator</th>
                                <th>Beneficiary</th>
                                <th>Gateway</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($escrows as $data)
                                <tr>
                                    <td>
                                        <a href="{{route('user.single', $data->user->id)}}">
                                            {{$data->user->username}}
                                        </a>
                                    </td>

                                    <td>{{$data->trx}}</td>
                                    <td>{{$data->gateway->name or ''}}</td>
                                    <td><strong>{{$data->amount}} {{$basic->currency}}</strong></td>
                                    <td>
                                        @if($data->status == 1)
                                            <a href="" class="btn btn-outline-success btn-sm ">
                                                <i class="fa fa-check"></i> Completed </a>
                                        @else
                                            <a href="" class="btn btn-outline-danger btn-sm ">
                                                <i class="fa fa-check"></i> Pending </a>
                                        @endif
                                    </td>
                                    <td>
                                        {{$data->updated_at}}
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                          <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Action
                                          </button>
                                          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item" href="{{route('admin.deposit.change.status', $data->trx)}}">Change Status</a>
                                            <a class="dropdown-item" href="{{route('deposit.destroy', $data->id)}}">Delete</a>
                                            
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